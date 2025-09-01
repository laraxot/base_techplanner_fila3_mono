<?php

declare(strict_types=1);

namespace Modules\Notify\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Notify\Models\NotifyTheme;
use Tests\TestCase;

class NotifyThemeTest extends TestCase
{


    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function it_can_create_notify_theme(): void
    {
        $theme = NotifyTheme::create([
            'lang' => 'it',
            'type' => 'email',
            'subject' => 'Benvenuto nella nostra piattaforma',
            'body' => 'Testo semplice del messaggio di benvenuto',
            'body_html' => '<h1>Benvenuto!</h1><p>Testo HTML del messaggio di benvenuto</p>',
            'from' => 'Sistema',
            'from_email' => 'noreply@example.com',
            'post_type' => 'App\Models\User',
            'post_id' => 123,
            'theme' => 'default',
            'logo_src' => '/images/logo.png',
            'logo_width' => 200,
            'logo_height' => 80,
            'view_params' => [
                'company_name' => 'Example Corp',
                'primary_color' => '#3b82f6',
                'secondary_color' => '#64748b',
            ],
        ]);

        $this->assertDatabaseHas('notify_themes', [
            'id' => $theme->id,
            'lang' => 'it',
            'type' => 'email',
            'subject' => 'Benvenuto nella nostra piattaforma',
            'body' => 'Testo semplice del messaggio di benvenuto',
            'body_html' => '<h1>Benvenuto!</h1><p>Testo HTML del messaggio di benvenuto</p>',
            'from' => 'Sistema',
            'from_email' => 'noreply@example.com',
            'post_type' => 'App\Models\User',
            'post_id' => 123,
            'theme' => 'default',
            'logo_src' => '/images/logo.png',
            'logo_width' => 200,
            'logo_height' => 80,
            'view_params' => json_encode([
                'company_name' => 'Example Corp',
                'primary_color' => '#3b82f6',
                'secondary_color' => '#64748b',
            ]),
        ]);

        expect(NotifyTheme::class, $theme);
    }

    /** @test */
    public function it_has_correct_fillable_fields(): void
    {
        $theme = new NotifyTheme;

        $expectedFillable = [
            'id',
            'lang',
            'type',
            'subject',
            'body',
            'body_html',
            'from',
            'from_email',
            'post_type',
            'post_id',
            'theme',
            'logo_src',
            'logo_width',
            'logo_height',
            'view_params',
        ];

        expect($expectedFillable, $theme->getFillable());
    }

    /** @test */
    public function it_has_correct_casts(): void
    {
        $theme = new NotifyTheme;

        $expectedCasts = [
            'id' => 'string',
            'uuid' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
            'updated_by' => 'string',
            'created_by' => 'string',
            'deleted_by' => 'string',
            'view_params' => 'array',
        ];

        expect($expectedCasts, $theme->casts());
    }

    /** @test */
    public function it_has_logo_appended_attribute(): void
    {
        $theme = new NotifyTheme;

        $expectedAppends = ['logo'];

        expect($expectedAppends, $theme->getAppends());
    }

    /** @test */
    public function it_can_store_json_view_params(): void
    {
        $viewParams = [
            'company_name' => 'Test Company',
            'primary_color' => '#ef4444',
            'secondary_color' => '#f59e0b',
            'accent_color' => '#10b981',
            'fonts' => [
                'primary' => 'Inter',
                'secondary' => 'Roboto',
            ],
            'layout' => [
                'max_width' => '1200px',
                'padding' => '20px',
                'border_radius' => '8px',
            ],
        ];

        $theme = NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Test Theme',
            'view_params' => $viewParams,
        ]);

        $this->assertDatabaseHas('notify_themes', [
            'id' => $theme->id,
            'view_params' => json_encode($viewParams),
        ]);

        $this->assertIsArray($theme->view_params);
        expect('Test Company', $theme->view_params['company_name']);
        expect('#ef4444', $theme->view_params['primary_color']);
        expect('Inter', $theme->view_params['fonts']['primary']);
        expect('1200px', $theme->view_params['layout']['max_width']);
    }

    /** @test */
    public function it_can_generate_logo_attribute(): void
    {
        $theme = NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Logo Test Theme',
            'logo_src' => '/images/custom-logo.png',
            'logo_width' => 300,
            'logo_height' => 120,
        ]);

        $logo = $theme->logo;

        $this->assertIsArray($logo);
        $this->assertArrayHasKey('path', $logo);
        $this->assertArrayHasKey('width', $logo);
        $this->assertArrayHasKey('height', $logo);
        expect(300, $logo['width']);
        expect(120, $logo['height']);
    }

    /** @test */
    public function it_uses_default_logo_dimensions_when_not_specified(): void
    {
        $theme = NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Default Logo Theme',
            'logo_src' => '/images/default-logo.png',
        ]);

        $logo = $theme->logo;

        expect(50, $logo['width']);
        expect(50, $logo['height']);
    }

    /** @test */
    public function it_can_update_theme(): void
    {
        $theme = NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Original Subject',
            'body' => 'Original body text',
            'theme' => 'original',
            'view_params' => ['original' => true],
        ]);

        $theme->update([
            'subject' => 'Updated Subject',
            'body' => 'Updated body text',
            'theme' => 'updated',
            'view_params' => ['updated' => true, 'version' => '2.0'],
        ]);

        $this->assertDatabaseHas('notify_themes', [
            'id' => $theme->id,
            'subject' => 'Updated Subject',
            'body' => 'Updated body text',
            'theme' => 'updated',
            'view_params' => json_encode(['updated' => true, 'version' => '2.0']),
        ]);

        expect('Updated Subject', $theme->fresh()->subject);
        expect('Updated body text', $theme->fresh()->body);
        expect('updated', $theme->fresh()->theme);
        expect(['updated' => true, 'version' => '2.0'], $theme->fresh()->view_params);
    }

    /** @test */
    public function it_can_find_by_language(): void
    {
        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Italian Welcome',
            'lang' => 'it',
        ]);

        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'English Welcome',
            'lang' => 'en',
        ]);

        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'German Welcome',
            'lang' => 'de',
        ]);

        $italianThemes = NotifyTheme::where('lang', 'it')->get();
        $englishThemes = NotifyTheme::where('lang', 'en')->get();
        $germanThemes = NotifyTheme::where('lang', 'de')->get();

        expect(1, $italianThemes);
        expect(1, $englishThemes);
        expect(1, $germanThemes);
        expect('it', $italianThemes[0]->lang);
        expect('en', $englishThemes[0]->lang);
        expect('de', $germanThemes[0]->lang);
    }

    /** @test */
    public function it_can_find_by_type(): void
    {
        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Email Theme',
            'lang' => 'it',
        ]);

        NotifyTheme::create([
            'type' => 'sms',
            'subject' => 'SMS Theme',
            'lang' => 'it',
        ]);

        NotifyTheme::create([
            'type' => 'push',
            'subject' => 'Push Theme',
            'lang' => 'it',
        ]);

        $emailThemes = NotifyTheme::where('type', 'email')->get();
        $smsThemes = NotifyTheme::where('type', 'sms')->get();
        $pushThemes = NotifyTheme::where('type', 'push')->get();

        expect(1, $emailThemes);
        expect(1, $smsThemes);
        expect(1, $pushThemes);
        expect('email', $emailThemes[0]->type);
        expect('sms', $smsThemes[0]->type);
        expect('push', $pushThemes[0]->type);
    }

    /** @test */
    public function it_can_find_by_theme_name(): void
    {
        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Default Theme',
            'theme' => 'default',
        ]);

        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Dark Theme',
            'theme' => 'dark',
        ]);

        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Custom Theme',
            'theme' => 'custom',
        ]);

        $defaultThemes = NotifyTheme::where('theme', 'default')->get();
        $darkThemes = NotifyTheme::where('theme', 'dark')->get();
        $customThemes = NotifyTheme::where('theme', 'custom')->get();

        expect(1, $defaultThemes);
        expect(1, $darkThemes);
        expect(1, $customThemes);
        expect('default', $defaultThemes[0]->theme);
        expect('dark', $darkThemes[0]->theme);
        expect('custom', $customThemes[0]->theme);
    }

    /** @test */
    public function it_can_find_by_post_type(): void
    {
        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'User Welcome',
            'post_type' => 'App\Models\User',
            'post_id' => 123,
        ]);

        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Company Welcome',
            'post_type' => 'App\Models\Company',
            'post_id' => 456,
        ]);

        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Order Confirmation',
            'post_type' => 'App\Models\Order',
            'post_id' => 789,
        ]);

        $userThemes = NotifyTheme::where('post_type', 'App\Models\User')->get();
        $companyThemes = NotifyTheme::where('post_type', 'App\Models\Company')->get();
        $orderThemes = NotifyTheme::where('post_type', 'App\Models\Order')->get();

        expect(1, $userThemes);
        expect(1, $companyThemes);
        expect(1, $orderThemes);
        expect('App\Models\User', $userThemes[0]->post_type);
        expect('App\Models\Company', $companyThemes[0]->post_type);
        expect('App\Models\Order', $orderThemes[0]->post_type);
    }

    /** @test */
    public function it_can_find_by_subject_pattern(): void
    {
        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Welcome to our platform',
            'lang' => 'it',
        ]);

        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Welcome to our service',
            'lang' => 'en',
        ]);

        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Order confirmation',
            'lang' => 'it',
        ]);

        $welcomeThemes = NotifyTheme::where('subject', 'like', '%Welcome%')->get();
        $orderThemes = NotifyTheme::where('subject', 'like', '%Order%')->get();

        expect(2, $welcomeThemes);
        expect(1, $orderThemes);
        $this->assertStringContainsString('Welcome', $welcomeThemes[0]->subject);
        $this->assertStringContainsString('Welcome', $welcomeThemes[1]->subject);
        $this->assertStringContainsString('Order', $orderThemes[0]->subject);
    }

    /** @test */
    public function it_can_find_by_from_email(): void
    {
        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'System Notification',
            'from' => 'System',
            'from_email' => 'system@example.com',
        ]);

        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Marketing Email',
            'from' => 'Marketing',
            'from_email' => 'marketing@example.com',
        ]);

        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Support Email',
            'from' => 'Support',
            'from_email' => 'support@example.com',
        ]);

        $systemThemes = NotifyTheme::where('from_email', 'system@example.com')->get();
        $marketingThemes = NotifyTheme::where('from_email', 'marketing@example.com')->get();
        $supportThemes = NotifyTheme::where('from_email', 'support@example.com')->get();

        expect(1, $systemThemes);
        expect(1, $marketingThemes);
        expect(1, $supportThemes);
        expect('system@example.com', $systemThemes[0]->from_email);
        expect('marketing@example.com', $marketingThemes[0]->from_email);
        expect('support@example.com', $supportThemes[0]->from_email);
    }

    /** @test */
    public function it_can_find_by_view_params_value(): void
    {
        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'High Priority Theme',
            'view_params' => [
                'priority' => 'high',
                'category' => 'security',
            ],
        ]);

        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Low Priority Theme',
            'view_params' => [
                'priority' => 'low',
                'category' => 'general',
            ],
        ]);

        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Medium Priority Theme',
            'view_params' => [
                'priority' => 'medium',
                'category' => 'maintenance',
            ],
        ]);

        $highPriorityThemes = NotifyTheme::whereJsonPath('view_params.priority', 'high')->get();
        $securityThemes = NotifyTheme::whereJsonPath('view_params.category', 'security')->get();

        expect(1, $highPriorityThemes);
        expect(1, $securityThemes);
        expect('high', $highPriorityThemes[0]->view_params['priority']);
        expect('security', $securityThemes[0]->view_params['category']);
    }

    /** @test */
    public function it_can_find_by_multiple_criteria(): void
    {
        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Italian High Priority Security',
            'lang' => 'it',
            'theme' => 'default',
            'view_params' => [
                'priority' => 'high',
                'category' => 'security',
            ],
        ]);

        NotifyTheme::create([
            'type' => 'email',
            'subject' => 'English Low Priority General',
            'lang' => 'en',
            'theme' => 'dark',
            'view_params' => [
                'priority' => 'low',
                'category' => 'general',
            ],
        ]);

        NotifyTheme::create([
            'type' => 'sms',
            'subject' => 'Italian Medium Priority Maintenance',
            'lang' => 'it',
            'theme' => 'custom',
            'view_params' => [
                'priority' => 'medium',
                'category' => 'maintenance',
            ],
        ]);

        $italianEmailHighPriority = NotifyTheme::where('lang', 'it')
            ->where('type', 'email')
            ->whereJsonPath('view_params.priority', 'high')
            ->get();

        expect(1, $italianEmailHighPriority);
        expect('it', $italianEmailHighPriority[0]->lang);
        expect('email', $italianEmailHighPriority[0]->type);
        expect('high', $italianEmailHighPriority[0]->view_params['priority']);
        expect('Italian High Priority Security', $italianEmailHighPriority[0]->subject);
    }

    /** @test */
    public function it_can_handle_null_values(): void
    {
        $theme = NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Null Values Theme',
            'lang' => null,
            'body' => null,
            'body_html' => null,
            'from' => null,
            'from_email' => null,
            'post_type' => null,
            'post_id' => null,
            'theme' => null,
            'logo_src' => null,
            'logo_width' => null,
            'logo_height' => null,
            'view_params' => null,
        ]);

        expect($theme->lang);
        expect($theme->body);
        expect($theme->body_html);
        expect($theme->from);
        expect($theme->from_email);
        expect($theme->post_type);
        expect($theme->post_id);
        expect($theme->theme);
        expect($theme->logo_src);
        expect($theme->logo_width);
        expect($theme->logo_height);
        expect($theme->view_params);
    }

    /** @test */
    public function it_can_handle_empty_view_params(): void
    {
        $theme = NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Empty Params Theme',
            'view_params' => [],
        ]);

        $this->assertDatabaseHas('notify_themes', [
            'id' => $theme->id,
            'view_params' => json_encode([]),
        ]);

        $this->assertIsArray($theme->view_params);
        $this->assertEmpty($theme->view_params);
    }

    /** @test */
    public function it_can_handle_complex_view_params(): void
    {
        $complexParams = [
            'branding' => [
                'logo' => [
                    'url' => '/images/logo.png',
                    'alt' => 'Company Logo',
                    'width' => 200,
                    'height' => 80,
                ],
                'colors' => [
                    'primary' => '#3b82f6',
                    'secondary' => '#64748b',
                    'accent' => '#f59e0b',
                    'success' => '#10b981',
                    'warning' => '#f59e0b',
                    'error' => '#ef4444',
                ],
                'fonts' => [
                    'heading' => 'Inter',
                    'body' => 'Roboto',
                    'mono' => 'JetBrains Mono',
                ],
            ],
            'layout' => [
                'container' => [
                    'max_width' => '1200px',
                    'padding' => '20px',
                    'margin' => '0 auto',
                ],
                'spacing' => [
                    'xs' => '4px',
                    'sm' => '8px',
                    'md' => '16px',
                    'lg' => '24px',
                    'xl' => '32px',
                ],
                'border_radius' => [
                    'sm' => '4px',
                    'md' => '8px',
                    'lg' => '12px',
                    'xl' => '16px',
                ],
            ],
            'features' => [
                'dark_mode' => true,
                'responsive' => true,
                'accessibility' => true,
                'animations' => false,
            ],
        ];

        $theme = NotifyTheme::create([
            'type' => 'email',
            'subject' => 'Complex Params Theme',
            'view_params' => $complexParams,
        ]);

        $this->assertDatabaseHas('notify_themes', [
            'id' => $theme->id,
            'view_params' => json_encode($complexParams),
        ]);

        expect('/images/logo.png', $theme->view_params['branding']['logo']['url']);
        expect('#3b82f6', $theme->view_params['branding']['colors']['primary']);
        expect('Inter', $theme->view_params['branding']['fonts']['heading']);
        expect('1200px', $theme->view_params['layout']['container']['max_width']);
        expect($theme->view_params['features']['dark_mode']);
        expect($theme->view_params['features']['animations']);
    }
}
