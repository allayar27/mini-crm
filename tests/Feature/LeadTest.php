<?php

namespace Tests\Feature;

use App\Enums\LeadStatus;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LeadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_cannot_view_lead_of_another_user(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();

        $lead = Lead::factory()->create([
            'assigned_to' => $owner->id,
        ]);

        $response = $this->actingAs($otherUser)
            ->get(route('leads.show', $lead));

        $response->assertForbidden();
    }

    /** @test */
    public function lead_cannot_be_created_without_full_name_and_phone(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('leads.store'), []);

        $response->assertSessionHasErrors([
            'full_name',
            'phone',
        ]);
    }
}
