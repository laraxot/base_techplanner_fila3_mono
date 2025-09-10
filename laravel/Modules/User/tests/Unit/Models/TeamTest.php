<?php

declare(strict_types=1);

namespace Modules\User\Tests\Unit\Models;

<<<<<<< HEAD
use Illuminate\Foundation\Testing\RefreshDatabase;
=======
use Illuminate\Foundation\Testing\DatabaseTransactions;
>>>>>>> 9831a351 (.)
use Modules\User\Models\Team;
use Modules\User\Models\User;
use Tests\TestCase;

class TeamTest extends TestCase
{
<<<<<<< HEAD
    use RefreshDatabase;
=======

>>>>>>> 9831a351 (.)

    public function test_can_create_team_with_minimal_data(): void
    {
        $user = User::factory()->create();
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        $team = Team::factory()->create([
            'user_id' => $user->id,
            'name' => 'Test Team',
        ]);

        $this->assertDatabaseHas('teams', [
            'id' => $team->id,
            'user_id' => $user->id,
            'name' => 'Test Team',
        ]);
    }

    public function test_can_create_team_with_all_fields(): void
    {
        $user = User::factory()->create();
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        $teamData = [
            'user_id' => $user->id,
            'name' => 'Full Team',
            'personal_team' => 0,
            'code' => 'TEAM001',
            'uuid' => '550e8400-e29b-41d4-a716-446655440000',
            'owner_id' => $user->id,
        ];

        $team = Team::factory()->create($teamData);

        $this->assertDatabaseHas('teams', [
            'id' => $team->id,
            'user_id' => $user->id,
            'name' => 'Full Team',
            'personal_team' => 0,
            'code' => 'TEAM001',
            'uuid' => '550e8400-e29b-41d4-a716-446655440000',
            'owner_id' => $user->id,
        ]);
    }

    public function test_team_has_soft_deletes(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create(['user_id' => $user->id]);
        $teamId = $team->id;

        $team->delete();

        $this->assertSoftDeleted('teams', ['id' => $teamId]);
        $this->assertDatabaseMissing('teams', ['id' => $teamId]);
    }

    public function test_can_restore_soft_deleted_team(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create(['user_id' => $user->id]);
        $teamId = $team->id;

        $team->delete();
        $this->assertSoftDeleted('teams', ['id' => $teamId]);

        $restoredTeam = Team::withTrashed()->find($teamId);
        $restoredTeam->restore();

        $this->assertDatabaseHas('teams', ['id' => $teamId]);
<<<<<<< HEAD
        $this->assertNull($restoredTeam->deleted_at);
=======
        expect($restoredTeam->deleted_at);
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_team_by_name(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create([
            'user_id' => $user->id,
            'name' => 'Unique Team Name',
        ]);

        $foundTeam = Team::where('name', 'Unique Team Name')->first();

<<<<<<< HEAD
        $this->assertNotNull($foundTeam);
        $this->assertEquals($team->id, $foundTeam->id);
=======
        expect($foundTeam);
        expect($team->id, $foundTeam->id);
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_team_by_code(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create([
            'user_id' => $user->id,
            'code' => 'TEAM123',
        ]);

        $foundTeam = Team::where('code', 'TEAM123')->first();

<<<<<<< HEAD
        $this->assertNotNull($foundTeam);
        $this->assertEquals($team->id, $foundTeam->id);
=======
        expect($foundTeam);
        expect($team->id, $foundTeam->id);
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_team_by_uuid(): void
    {
        $user = User::factory()->create();
        $uuid = '550e8400-e29b-41d4-a716-446655440000';
        $team = Team::factory()->create([
            'user_id' => $user->id,
            'uuid' => $uuid,
        ]);

        $foundTeam = Team::where('uuid', $uuid)->first();

<<<<<<< HEAD
        $this->assertNotNull($foundTeam);
        $this->assertEquals($team->id, $foundTeam->id);
=======
        expect($foundTeam);
        expect($team->id, $foundTeam->id);
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_team_by_owner_id(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create([
            'user_id' => $user->id,
            'owner_id' => $user->id,
        ]);

        $foundTeam = Team::where('owner_id', $user->id)->first();

<<<<<<< HEAD
        $this->assertNotNull($foundTeam);
        $this->assertEquals($team->id, $foundTeam->id);
=======
        expect($foundTeam);
        expect($team->id, $foundTeam->id);
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_personal_teams(): void
    {
        $user = User::factory()->create();
        Team::factory()->create([
            'user_id' => $user->id,
            'personal_team' => 1,
        ]);
        Team::factory()->create([
            'user_id' => $user->id,
            'personal_team' => 0,
        ]);

        $personalTeams = Team::where('personal_team', 1)->get();

<<<<<<< HEAD
        $this->assertCount(1, $personalTeams);
        $this->assertEquals(1, $personalTeams->first()->personal_team);
=======
        expect(1, $personalTeams);
        expect(1, $personalTeams->first()->personal_team);
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_teams_by_user_id(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        Team::factory()->create(['user_id' => $user1->id]);
        Team::factory()->create(['user_id' => $user1->id]);
        Team::factory()->create(['user_id' => $user2->id]);

        $user1Teams = Team::where('user_id', $user1->id)->get();

<<<<<<< HEAD
        $this->assertCount(2, $user1Teams);
        $this->assertTrue($user1Teams->every(fn ($team) => $team->user_id === $user1->id));
=======
        expect(2, $user1Teams);
        expect($user1Teams->every(fn ($team) => $team->user_id === $user1->id));
>>>>>>> 9831a351 (.)
    }

    public function test_can_find_teams_by_name_pattern(): void
    {
        $user = User::factory()->create();
        Team::factory()->create(['user_id' => $user->id, 'name' => 'Development Team']);
        Team::factory()->create(['user_id' => $user->id, 'name' => 'Marketing Team']);
        Team::factory()->create(['user_id' => $user->id, 'name' => 'Sales Team']);

        $devTeams = Team::where('name', 'like', '%Team%')->get();

<<<<<<< HEAD
        $this->assertCount(3, $devTeams);
        $this->assertTrue($devTeams->every(fn ($team) => str_contains($team->name, 'Team')));
=======
        expect(3, $devTeams);
        expect($devTeams->every(fn ($team) => str_contains($team->name, 'Team')));
>>>>>>> 9831a351 (.)
    }

    public function test_can_update_team(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create([
            'user_id' => $user->id,
            'name' => 'Old Name',
        ]);

        $team->update(['name' => 'New Name']);

        $this->assertDatabaseHas('teams', [
            'id' => $team->id,
            'name' => 'New Name',
        ]);
    }

    public function test_can_handle_null_values(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create([
            'user_id' => $user->id,
            'name' => 'Test Team',
            'code' => null,
            'uuid' => null,
            'owner_id' => null,
        ]);

        $this->assertDatabaseHas('teams', [
            'id' => $team->id,
            'code' => null,
            'uuid' => null,
            'owner_id' => null,
        ]);
    }

    public function test_can_find_teams_by_multiple_criteria(): void
    {
        $user = User::factory()->create();
        Team::factory()->create([
            'user_id' => $user->id,
            'name' => 'Development Team',
            'personal_team' => 0,
        ]);

        Team::factory()->create([
            'user_id' => $user->id,
            'name' => 'Personal Team',
            'personal_team' => 1,
        ]);

        $teams = Team::where('user_id', $user->id)
            ->where('personal_team', 0)
            ->get();

<<<<<<< HEAD
        $this->assertCount(1, $teams);
        $this->assertEquals('Development Team', $teams->first()->name);
        $this->assertEquals(0, $teams->first()->personal_team);
    }
}







=======
        expect(1, $teams);
        expect('Development Team', $teams->first()->name);
        expect(0, $teams->first()->personal_team);
    }
}
<<<<<<< HEAD



<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> 8a21b63 (.)
=======

=======
>>>>>>> a0c18bc (.)
>>>>>>> 8055579 (.)
=======
>>>>>>> d51888e (.)
>>>>>>> 9831a351 (.)
