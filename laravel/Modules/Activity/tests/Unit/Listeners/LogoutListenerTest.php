<?php

declare(strict_types=1);

<<<<<<< HEAD
namespace Modules\Activity\Tests\Unit\Listeners;

=======
>>>>>>> f371b59 (.)
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Modules\Activity\Listeners\LogoutListener;
use Modules\Activity\Models\Activity;
use Modules\User\Models\User;

test('logout listener is registered for logout event', function () {
    Event::fake();
<<<<<<< HEAD

=======
    
>>>>>>> f371b59 (.)
    Event::assertListening(
        Logout::class,
        LogoutListener::class
    );
});

test('logout listener handles logout event and creates activity', function () {
    $user = User::factory()->create();
    $event = new Logout('web', $user);
<<<<<<< HEAD

    $listener = new LogoutListener;
    $listener->handle($event);

=======
    
    $listener = new LogoutListener();
    $listener->handle($event);
    
>>>>>>> f371b59 (.)
    $activity = Activity::where('causer_type', User::class)
        ->where('causer_id', $user->id)
        ->where('event', 'logout')
        ->first();
<<<<<<< HEAD

=======
    
>>>>>>> f371b59 (.)
    expect($activity)->not->toBeNull()
        ->description->toContain('logout')
        ->causer_id->toBe($user->id)
        ->causer_type->toBe(User::class)
        ->properties->toHaveKey('guard', 'web');
});

test('logout listener creates activity with correct properties', function () {
    $user = User::factory()->create();
    $event = new Logout('api', $user);
<<<<<<< HEAD

    $listener = new LogoutListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->latest()->first();

=======
    
    $listener = new LogoutListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->latest()->first();
    
>>>>>>> f371b59 (.)
    expect($activity->properties)
        ->toHaveKey('guard', 'api')
        ->toHaveKey('ip_address')
        ->toHaveKey('user_agent')
        ->toHaveKey('timestamp');
});

test('logout listener handles multiple logout events correctly', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
<<<<<<< HEAD

    $event1 = new Logout('web', $user1);
    $event2 = new Logout('api', $user2);

    $listener = new LogoutListener;
    $listener->handle($event1);
    $listener->handle($event2);

    $activities = Activity::whereIn('causer_id', [$user1->id, $user2->id])->get();

    expect($activities)->toHaveCount(2);

    $user1Activity = $activities->where('causer_id', $user1->id)->first();
    $user2Activity = $activities->where('causer_id', $user2->id)->first();

=======
    
    $event1 = new Logout('web', $user1);
    $event2 = new Logout('api', $user2);
    
    $listener = new LogoutListener();
    $listener->handle($event1);
    $listener->handle($event2);
    
    $activities = Activity::whereIn('causer_id', [$user1->id, $user2->id])->get();
    
    expect($activities)->toHaveCount(2);
    
    $user1Activity = $activities->where('causer_id', $user1->id)->first();
    $user2Activity = $activities->where('causer_id', $user2->id)->first();
    
>>>>>>> f371b59 (.)
    expect($user1Activity->properties['guard'])->toBe('web');
    expect($user2Activity->properties['guard'])->toBe('api');
});

test('logout listener includes session duration when available', function () {
    $user = User::factory()->create();
<<<<<<< HEAD

    $loginTime = now()->subHours(2);
    $user->last_login_at = $loginTime;
    $user->save();

    $event = new Logout('web', $user);

    $listener = new LogoutListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();

=======
    
    $loginTime = now()->subHours(2);
    $user->last_login_at = $loginTime;
    $user->save();
    
    $event = new Logout('web', $user);
    
    $listener = new LogoutListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->first();
    
>>>>>>> f371b59 (.)
    expect($activity->properties)
        ->toHaveKey('session_duration')
        ->session_duration->toBeGreaterThanOrEqual(7200);
});

test('logout listener uses correct log name for activities', function () {
    $user = User::factory()->create();
    $event = new Logout('web', $user);
<<<<<<< HEAD

    $listener = new LogoutListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();

=======
    
    $listener = new LogoutListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->first();
    
>>>>>>> f371b59 (.)
    expect($activity->log_name)->toBe('auth');
});

test('logout listener handles event without user gracefully', function () {
    $event = new Logout('web', null);
<<<<<<< HEAD

    $listener = new LogoutListener;

    expect(fn () => $listener->handle($event))->not->toThrow(Exception::class);

=======
    
    $listener = new LogoutListener();
    
    expect(fn() => $listener->handle($event))->not->toThrow(Exception::class);
    
>>>>>>> f371b59 (.)
    $activities = Activity::where('event', 'logout')->get();
    expect($activities)->toBeEmpty();
});

test('logout listener creates unique activities for same user different sessions', function () {
    $user = User::factory()->create();
<<<<<<< HEAD

    $event1 = new Logout('web', $user);
    $event2 = new Logout('api', $user);

    $listener = new LogoutListener;
    $listener->handle($event1);
    $listener->handle($event2);

    $activities = Activity::where('causer_id', $user->id)->get();

    expect($activities)->toHaveCount(2);

    $firstActivity = $activities->first();
    $lastActivity = $activities->last();

=======
    
    $event1 = new Logout('web', $user);
    $event2 = new Logout('api', $user);
    
    $listener = new LogoutListener();
    $listener->handle($event1);
    $listener->handle($event2);
    
    $activities = Activity::where('causer_id', $user->id)->get();
    
    expect($activities)->toHaveCount(2);
    
    $firstActivity = $activities->first();
    $lastActivity = $activities->last();
    
>>>>>>> f371b59 (.)
    expect($firstActivity->properties['guard'])->toBe('web');
    expect($lastActivity->properties['guard'])->toBe('api');
    expect($firstActivity->id)->not->toBe($lastActivity->id);
});

test('logout listener tracks logout reason when provided', function () {
    $user = User::factory()->create();
    $event = new Logout('web', $user);
<<<<<<< HEAD

    $listener = new LogoutListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();

=======
    
    $listener = new LogoutListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->first();
    
>>>>>>> f371b59 (.)
    expect($activity->properties)
        ->toHaveKey('logout_reason', 'user_initiated');
});

test('logout listener handles concurrent logout events', function () {
    $users = User::factory()->count(5)->create();
<<<<<<< HEAD

    $events = $users->map(fn ($user) => new Logout('web', $user));

    $listener = new LogoutListener;

    foreach ($events as $event) {
        $listener->handle($event);
    }

    $activities = Activity::where('event', 'logout')->get();

    expect($activities)->toHaveCount(5);

    $userIds = $activities->pluck('causer_id')->unique();
    expect($userIds)->toHaveCount(5);
});
=======
    
    $events = $users->map(fn($user) => new Logout('web', $user));
    
    $listener = new LogoutListener();
    
    foreach ($events as $event) {
        $listener->handle($event);
    }
    
    $activities = Activity::where('event', 'logout')->get();
    
    expect($activities)->toHaveCount(5);
    
    $userIds = $activities->pluck('causer_id')->unique();
    expect($userIds)->toHaveCount(5);
});
>>>>>>> f371b59 (.)
