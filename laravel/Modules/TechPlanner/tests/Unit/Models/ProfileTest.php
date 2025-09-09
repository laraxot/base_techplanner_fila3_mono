<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Tests\Unit\Models;

use Modules\TechPlanner\Models\Profile;

/**
 * Test unitario per il modello Profile.
 *
 * @covers \Modules\TechPlanner\Models\Profile
 */
class ProfileTest extends TestCase
{
    private Profile $profile;

    protected function setUp(): void
    {
        parent::setUp();
        $this->profile = Profile::factory()->create();
    }

    /** @test */
    public function it_can_create_profile(): void
    {
        $this->assertDatabaseHas('profiles', [
            'id' => $this->profile->id,
        ]);
    }

    /** @test */
    public function it_has_required_fields(): void
    {
        $this->assertDatabaseHas('profiles', [
            'id' => $this->profile->id,
            'user_id' => $this->profile->user_id,
            'type' => $this->profile->type,
        ]);
    }

    /** @test */
    public function it_has_soft_deletes(): void
    {
        $this->profile->delete();
        $this->assertSoftDeleted('profiles', ['id' => $this->profile->id]);
    }

    /** @test */
    public function it_can_be_restored(): void
    {
        $this->profile->delete();
        $this->profile->restore();
        $this->assertDatabaseHas('profiles', ['id' => $this->profile->id]);
    }

    /** @test */
    public function it_has_type_scope(): void
    {
        Profile::factory()->create(['type' => 'personal']);
        Profile::factory()->create(['type' => 'professional']);

        $personalProfiles = Profile::ofType('personal')->get();
        $this->assertEquals(1, $personalProfiles->count());
    }

    /** @test */
    public function it_has_active_scope(): void
    {
        Profile::factory()->create(['is_active' => true]);
        Profile::factory()->create(['is_active' => false]);

        $activeProfiles = Profile::active()->get();
        $this->assertEquals(1, $activeProfiles->count());
    }

    /** @test */
    public function it_has_user_scope(): void
    {
        Profile::factory()->create(['user_id' => 1]);
        Profile::factory()->create(['user_id' => 2]);

        $user1Profiles = Profile::forUser(1)->get();
        $this->assertEquals(1, $user1Profiles->count());
    }

    /** @test */
    public function it_handles_profile_bio(): void
    {
        $bio = 'Sviluppatore software con passione per l\'innovazione tecnologica';
        $this->profile->bio = $bio;
        $this->profile->save();

        $this->assertDatabaseHas('profiles', [
            'id' => $this->profile->id,
            'bio' => $bio,
        ]);
    }

    /** @test */
    public function it_handles_profile_avatar(): void
    {
        $avatar = 'profiles/avatar_123.jpg';
        $this->profile->avatar = $avatar;
        $this->profile->save();

        $this->assertDatabaseHas('profiles', [
            'id' => $this->profile->id,
            'avatar' => $avatar,
        ]);
    }

    /** @test */
    public function it_handles_profile_website(): void
    {
        $website = 'https://www.mioprofilo.it';
        $this->profile->website = $website;
        $this->profile->save();

        $this->assertDatabaseHas('profiles', [
            'id' => $this->profile->id,
            'website' => $website,
        ]);
    }

    /** @test */
    public function it_handles_profile_social_links(): void
    {
        $socialLinks = [
            'linkedin' => 'https://linkedin.com/in/mioprofilo',
            'twitter' => 'https://twitter.com/mioprofilo',
            'github' => 'https://github.com/mioprofilo'
            'github' => 'https://github.com/mioprofilo',
            'github' => 'https://github.com/mioprofilo'
        ];
        $this->profile->social_links = $socialLinks;
        $this->profile->save();

        $this->assertDatabaseHas('profiles', [
            'id' => $this->profile->id,
            'social_links' => json_encode($socialLinks),
        ]);
    }

    /** @test */
    public function it_handles_profile_preferences(): void
    {
        $preferences = [
            'language' => 'it',
            'timezone' => 'Europe/Rome',
            'notifications' => ['email', 'sms'],
            'privacy' => ['public_profile', 'show_email']
            'privacy' => ['public_profile', 'show_email'],
            'privacy' => ['public_profile', 'show_email']
        ];
        $this->profile->preferences = $preferences;
        $this->profile->save();

        $this->assertDatabaseHas('profiles', [
            'id' => $this->profile->id,
            'preferences' => json_encode($preferences),
        ]);
    }

    /** @test */
    public function it_handles_profile_skills(): void
    {
        $skills = ['PHP', 'Laravel', 'JavaScript', 'Vue.js', 'MySQL'];
        $this->profile->skills = $skills;
        $this->profile->save();

        $this->assertDatabaseHas('profiles', [
            'id' => $this->profile->id,
            'skills' => json_encode($skills),
        ]);
    }

    /** @test */
    public function it_handles_profile_experience(): void
    {
        $experience = [
            [
                'company' => 'TechCorp',
                'position' => 'Senior Developer',
                'start_date' => '2020-01-01',
                'end_date' => null,
                'description' => 'Sviluppo applicazioni web enterprise'
                'description' => 'Sviluppo applicazioni web enterprise',
                'description' => 'Sviluppo applicazioni web enterprise'
            ],
            [
                'company' => 'StartupLab',
                'position' => 'Full Stack Developer',
                'start_date' => '2018-06-01',
                'end_date' => '2019-12-31',
                'description' => 'Sviluppo MVP e applicazioni web'
            ]
                'description' => 'Sviluppo MVP e applicazioni web',
            ],
                'description' => 'Sviluppo MVP e applicazioni web'
            ]
        ];
        $this->profile->experience = $experience;
        $this->profile->save();

        $this->assertDatabaseHas('profiles', [
            'id' => $this->profile->id,
            'experience' => json_encode($experience),
        ]);
    }

    /** @test */
    public function it_handles_profile_education(): void
    {
        $education = [
            [
                'institution' => 'Università di Roma',
                'degree' => 'Laurea in Informatica',
                'field' => 'Computer Science',
                'start_date' => '2015-09-01',
                'end_date' => '2018-07-31',
                'gpa' => 3.8
            ]
                'gpa' => 3.8,
            ],
                'gpa' => 3.8
            ]
        ];
        $this->profile->education = $education;
        $this->profile->save();

        $this->assertDatabaseHas('profiles', [
            'id' => $this->profile->id,
            'education' => json_encode($education),
        ]);
    }

    /** @test */
    public function it_handles_profile_certifications(): void
    {
        $certifications = [
            [
                'name' => 'AWS Certified Developer',
                'issuer' => 'Amazon Web Services',
                'issue_date' => '2022-03-15',
                'expiry_date' => '2025-03-15',
                'credential_id' => 'AWS-123456'
                'credential_id' => 'AWS-123456',
                'credential_id' => 'AWS-123456'
            ],
            [
                'name' => 'Laravel Certified Developer',
                'issuer' => 'Laravel',
                'issue_date' => '2021-11-20',
                'expiry_date' => null,
                'credential_id' => 'LAR-789012'
            ]
                'credential_id' => 'LAR-789012',
            ],
                'credential_id' => 'LAR-789012'
            ]
        ];
        $this->profile->certifications = $certifications;
        $this->profile->save();

        $this->assertDatabaseHas('profiles', [
            'id' => $this->profile->id,
            'certifications' => json_encode($certifications),
        ]);
    }

    /** @test */
    public function it_handles_profile_languages(): void
    {
        $languages = [
            'italiano' => ['level' => 'Nativo', 'certification' => null],
            'inglese' => ['level' => 'Avanzato', 'certification' => 'IELTS 7.5'],
            'francese' => ['level' => 'Intermedio', 'certification' => 'DELF B2']
            'francese' => ['level' => 'Intermedio', 'certification' => 'DELF B2'],
            'francese' => ['level' => 'Intermedio', 'certification' => 'DELF B2']
        ];
        $this->profile->languages = $languages;
        $this->profile->save();

        $this->assertDatabaseHas('profiles', [
            'id' => $this->profile->id,
            'languages' => json_encode($languages),
        ]);
    }

    /** @test */
    public function it_handles_profile_interests(): void
    {
        $interests = ['Intelligenza Artificiale', 'Machine Learning', 'Open Source', 'Viaggi', 'Fotografia'];
        $this->profile->interests = $interests;
        $this->profile->save();

        $this->assertDatabaseHas('profiles', [
            'id' => $this->profile->id,
            'interests' => json_encode($interests),
        ]);
    }

    /** @test */
    public function it_handles_profile_notes(): void
    {
        $notes = 'Profilo professionale aggiornato con esperienze recenti';
        $this->profile->notes = $notes;
        $this->profile->save();

        $this->assertDatabaseHas('profiles', [
            'id' => $this->profile->id,
            'notes' => $notes,
        ]);
    }

    /** @test */
    public function it_serializes_to_array(): void
    {
        $array = $this->profile->toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('user_id', $array);
        $this->assertArrayHasKey('type', $array);
    }

    /** @test */
    public function it_serializes_to_json(): void
    {
        $json = $this->profile->toJson();

        $this->assertIsString($json);
        $this->assertStringContainsString('user_id', $json);
        $this->assertStringContainsString('type', $json);
    }

    /** @test */
    public function it_handles_profile_status(): void
    {
        $this->profile->status = 'active';
        $this->profile->save();

        $this->assertTrue($this->profile->isActive());
    }

    /** @test */
    public function it_handles_profile_type(): void
    {
        $this->profile->type = 'professional';
        $this->profile->save();

        $this->assertTrue($this->profile->isProfessional());
    }

    /** @test */
    public function it_has_avatar_url_accessor(): void
    {
        $this->profile->avatar = 'profiles/avatar.jpg';
        $this->profile->save();

        $this->assertStringContainsString('profiles/avatar.jpg', $this->profile->avatar_url);
    }

    /** @test */
    public function it_has_skills_count_accessor(): void
    {
        $this->profile->skills = ['PHP', 'Laravel', 'JavaScript'];
        $this->profile->save();

        $this->assertEquals(3, $this->profile->skills_count);
    }

    /** @test */
    public function it_has_experience_years_accessor(): void
    {
        $this->profile->experience = [
            [
                'company' => 'TechCorp',
                'start_date' => '2020-01-01',
                'end_date' => null
            ]
                'end_date' => null,
            ],
                'end_date' => null
            ]
        ];
        $this->profile->save();

        $this->assertGreaterThan(0, $this->profile->total_experience_years);
    }

    /** @test */
    public function it_has_certification_count_accessor(): void
    {
        $this->profile->certifications = [
            ['name' => 'AWS Certified Developer'],
            ['name' => 'Laravel Certified Developer']
            ['name' => 'Laravel Certified Developer'],
            ['name' => 'Laravel Certified Developer']
        ];
        $this->profile->save();

        $this->assertEquals(2, $this->profile->certification_count);
    }
}
