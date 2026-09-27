<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LibrarySystemTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $peminjam;
    private Category $category;
    private Book $bookWithStock;
    private Book $bookZeroStock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'role' => 'admin',
        ]);

        $this->peminjam = User::factory()->create([
            'name' => 'Peminjam Test',
            'email' => 'peminjam@test.com',
            'role' => 'peminjam',
        ]);

        $this->category = Category::create([
            'name' => 'Teknologi',
            'slug' => 'teknologi',
        ]);

        $this->bookWithStock = Book::create([
            'category_id' => $this->category->id,
            'title' => 'Clean Code Test',
            'author' => 'Robert C. Martin',
            'stock' => 5,
        ]);

        $this->bookZeroStock = Book::create([
            'category_id' => $this->category->id,
            'title' => 'Out of Stock Book',
            'author' => 'Author Test',
            'stock' => 0,
        ]);
    }

    public function test_peminjam_cannot_access_admin_dashboard_url(): void
    {
        $response = $this->actingAs($this->peminjam)->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    public function test_peminjam_cannot_access_admin_books_crud_url(): void
    {
        $response = $this->actingAs($this->peminjam)->get('/admin/books');
        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/dashboard');
        $response->assertStatus(200);
    }

    public function test_admin_can_create_new_book(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/books', [
            'title' => 'New Awesome Book',
            'author' => 'Great Author',
            'category_id' => $this->category->id,
            'stock' => 10,
            'description' => 'Test description',
        ]);

        $response->assertRedirect('/admin/books');
        $this->assertDatabaseHas('books', [
            'title' => 'New Awesome Book',
            'stock' => 10,
        ]);
    }

    public function test_peminjam_can_borrow_book_with_stock_and_decrements_stock(): void
    {
        $initialStock = $this->bookWithStock->stock;

        $response = $this->actingAs($this->peminjam)->post("/katalog/pinjam/{$this->bookWithStock->id}", [
            'duration' => 7,
        ]);

        $response->assertRedirect(route('peminjam.borrowings.history'));
        $this->assertDatabaseHas('borrowings', [
            'user_id' => $this->peminjam->id,
            'book_id' => $this->bookWithStock->id,
            'status' => 'dipinjam',
        ]);

        $borrowing = Borrowing::where('user_id', $this->peminjam->id)->where('book_id', $this->bookWithStock->id)->first();
        $this->assertNotNull($borrowing);
        $this->assertEquals(now()->addDays(7)->toDateString(), $borrowing->due_date->toDateString());
        $this->assertEquals($initialStock - 1, $this->bookWithStock->fresh()->stock);
    }

    public function test_peminjam_can_borrow_book_with_custom_duration(): void
    {
        $initialStock = $this->bookWithStock->stock;

        $response = $this->actingAs($this->peminjam)->post("/katalog/pinjam/{$this->bookWithStock->id}", [
            'duration' => 14,
        ]);

        $response->assertRedirect(route('peminjam.borrowings.history'));
        $this->assertDatabaseHas('borrowings', [
            'user_id' => $this->peminjam->id,
            'book_id' => $this->bookWithStock->id,
            'status' => 'dipinjam',
        ]);

        $borrowing = Borrowing::where('user_id', $this->peminjam->id)->where('book_id', $this->bookWithStock->id)->first();
        $this->assertNotNull($borrowing);
        $this->assertEquals(now()->addDays(14)->toDateString(), $borrowing->due_date->toDateString());
        $this->assertEquals(14, $borrowing->duration_days);
        $this->assertEquals($initialStock - 1, $this->bookWithStock->fresh()->stock);
    }

    public function test_peminjam_cannot_borrow_book_with_zero_stock(): void
    {
        $response = $this->actingAs($this->peminjam)->post("/katalog/pinjam/{$this->bookZeroStock->id}");

        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('borrowings', [
            'user_id' => $this->peminjam->id,
            'book_id' => $this->bookZeroStock->id,
        ]);
        $this->assertEquals(0, $this->bookZeroStock->fresh()->stock);
    }

    public function test_peminjam_can_return_borrowed_book_and_increments_stock(): void
    {
        $borrowing = Borrowing::create([
            'user_id' => $this->peminjam->id,
            'book_id' => $this->bookWithStock->id,
            'borrow_date' => now()->toDateString(),
            'due_date' => now()->addDays(7)->toDateString(),
            'status' => 'dipinjam',
        ]);
        $initialStock = $this->bookWithStock->stock;

        $response = $this->actingAs($this->peminjam)->post("/riwayat-saya/kembalikan/{$borrowing->id}");

        $response->assertRedirect(route('peminjam.borrowings.history'));
        $this->assertDatabaseHas('borrowings', [
            'id' => $borrowing->id,
            'status' => 'dikembalikan',
        ]);
        $this->assertEquals($initialStock + 1, $this->bookWithStock->fresh()->stock);
    }

    public function test_peminjam_cannot_see_other_users_borrowing_history(): void
    {
        $otherUser = User::factory()->create([
            'name' => 'Other User',
            'email' => 'other@test.com',
            'role' => 'peminjam',
        ]);

        $otherBorrowing = Borrowing::create([
            'user_id' => $otherUser->id,
            'book_id' => $this->bookWithStock->id,
            'borrow_date' => now()->toDateString(),
            'due_date' => now()->addDays(7)->toDateString(),
            'status' => 'dipinjam',
        ]);

        $response = $this->actingAs($this->peminjam)->get('/riwayat-saya');
        $response->assertStatus(200);
        $response->assertDontSee($otherUser->email);
    }

    public function test_live_search_ajax_returns_json_with_html(): void
    {
        $response = $this->actingAs($this->peminjam)
            ->getJson('/katalog/search?q=Clean');

        $response->assertStatus(200);
        $response->assertJsonStructure(['html', 'count']);
        $this->assertStringContainsString('Clean Code Test', $response->json('html'));
    }
}
