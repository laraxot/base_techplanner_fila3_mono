<?php

declare(strict_types=1);

<<<<<<< HEAD
namespace Modules\Activity\Tests\Unit\Listeners;

=======
>>>>>>> f371b59 (.)
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Modules\Activity\Listeners\LoginListener;
use Modules\Activity\Models\Activity;
use Modules\User\Models\User;

test('login listener is registered for login event', function () {
    Event::fake();
<<<<<<< HEAD

=======
    
>>>>>>> f371b59 (.)
    Event::assertListening(
        Login::class,
        LoginListener::class
    );
});

test('login listener handles login event and creates activity', function () {
    $user = User::factory()->create();
    $event = new Login('web', $user, false);
<<<<<<< HEAD

    $listener = new LoginListener;
    $listener->handle($event);

=======
    
    $listener = new LoginListener();
    $listener->handle($event);
    
>>>>>>> f371b59 (.)
    $activity = Activity::where('causer_type', User::class)
        ->where('causer_id', $user->id)
        ->where('event', 'login')
        ->first();
<<<<<<< HEAD

=======
    
>>>>>>> f371b59 (.)
    expect($activity)->not->toBeNull()
        ->description->toContain('login')
        ->causer_id->toBe($user->id)
        ->causer_type->toBe(User::class)
        ->properties->toHaveKey('guard', 'web');
});

test('login listener creates activity with correct properties', function () {
    $user = User::factory()->create();
    $event = new Login('api', $user, true);
<<<<<<< HEAD

    $listener = new LoginListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->latest()->first();

=======
    
    $listener = new LoginListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->latest()->first();
    
>>>>>>> f371b59 (.)
    expect($activity->properties)
        ->toHaveKey('guard', 'api')
        ->toHaveKey('remember', true)
        ->toHaveKey('ip_address')
        ->toHaveKey('user_agent');
});

test('login listener handles multiple login events correctly', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
<<<<<<< HEAD

    $event1 = new Login('web', $user1, false);
    $event2 = new Login('api', $user2, true);

    $listener = new LoginListener;
    $listener->handle($event1);
    $listener->handle($event2);

    $activities = Activity::whereIn('causer_id', [$user1->id, $user2->id])->get();

    expect($activities)->toHaveCount(2);

    $user1Activity = $activities->where('causer_id', $user1->id)->first();
    $user2Activity = $activities->where('causer_id', $user2->id)->first();

=======
    
    $event1 = new Login('web', $user1, false);
    $event2 = new Login('api', $user2, true);
    
    $listener = new LoginListener();
    $listener->handle($event1);
    $listener->handle($event2);
    
    $activities = Activity::whereIn('causer_id', [$user1->id, $user2->id])->get();
    
    expect($activities)->toHaveCount(2);
    
    $user1Activity = $activities->where('causer_id', $user1->id)->first();
    $user2Activity = $activities->where('causer_id', $user2->id)->first();
    
>>>>>>> f371b59 (.)
    expect($user1Activity->properties['guard'])->toBe('web');
    expect($user2Activity->properties['guard'])->toBe('api');
    expect($user1Activity->properties['remember'])->toBeFalse();
    expect($user2Activity->properties['remember'])->toBeTrue();
});

test('login listener includes request information in activity properties', function () {
    $user = User::factory()->create();
    $event = new Login('web', $user, false);
<<<<<<< HEAD

    $listener = new LoginListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();

=======
    
    $listener = new LoginListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->first();
    
>>>>>>> f371b59 (.)
    expect($activity->properties)
        ->toHaveKey('ip_address')
        ->toHaveKey('user_agent')
        ->toHaveKey('timestamp');
});

test('login listener uses correct log name for activities', function () {
    $user = User::factory()->create();
    $event = new Login('web', $user, false);
<<<<<<< HEAD

    $listener = new LoginListener;
    $listener->handle($event);

    $activity = Activity::where('causer_id', $user->id)->first();

=======
    
    $listener = new LoginListener();
    $listener->handle($event);
    
    $activity = Activity::where('causer_id', $user->id)->first();
    
>>>>>>> f371b59 (.)
    expect($activity->log_name)->toBe('auth');
});

test('login listener handles event without user gracefully', function () {
    $event = new Login('web', null, false);
<<<<<<< HEAD

    $listener = new LoginListener;

    expect(fn () => $listener->handle($event))->not->toThrow(Exception::class);

=======
    
    $listener = new LoginListener();
    
    expect(fn() => $listener->handle($event))->not->toThrow(Exception::class);
    
>>>>>>> f371b59 (.)
    $activities = Activity::where('event', 'login')->get();
    expect($activities)->toBeEmpty();
});

test('login listener creates unique activities for same user different sessions', function () {
    $user = User::factory()->create();
<<<<<<< HEAD

    $event1 = new Login('web', $user, false);
    $event2 = new Login('web', $user, true);

    $listener = new LoginListener;
    $listener->handle($event1);
    $listener->handle($event2);

    $activities = Activity::where('causer_id', $user->id)->get();

    expect($activities)->toHaveCount(2);

    $firstActivity = $activities->first();
    $lastActivity = $activities->last();

    expect($firstActivity->properties['remember'])->toBeFalse();
    expect($lastActivity->properties['remember'])->toBeTrue();
    expect($firstActivity->id)->not->toBe($lastActivity->id);
});
=======
    
    $event1 = new Login('web', $user, false);
    $event2 = new Login('web', $user, true);
    
    $listener = new LoginListener();
    $listener->handle($event1);
    $listener->handle($event2);
    
    $activities = Activity::where('causer_id', $user->id)->get();
    
    expect($activities)->toHaveCount(2);
    
    $firstActivity = $activities->first();
    $lastActivity = $activities->last();
    
    expect($firstActivity->properties['remember'])->toBeFalse();
    expect($lastActivity->properties['remember'])->toBeTrue();
    expect($firstActivity->id)->not->toBe($lastActivity->id);
});
>>>>>>> f371b59 (.)
