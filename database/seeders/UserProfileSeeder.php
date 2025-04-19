<?php
namespace Database\Seeders;

use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserProfile::create([
            'user_type'       => 0,
            'user_details'    => 'User',
            'name'            => 'User',
            'lname'           => 'type',
            'email'           => 'user@gmail.com',
            'phone'           => '4545544554',
            'address'         => 'pratap nagar',
            'logo'            => 'User/assets/img/profile/default.png',
            'status'          => 1,
            'password'        => '$2y$10$4t6.SMEjYWhVl0WSvEayi.KllPUG.BB072xbrn93fl1Ojg8kfTR1.',
            'date_of_birth'   => '1990-05-15',
            'gender'          => 'Male',
            'education_level' => 'PG',
            'qualification'   => 'MSc Computer Science',
            'branch'          => 'Information Technology',
            'language' => json_encode(['English', 'Spanish', 'Hindi']),

            'experience'      => 5,
            'look_job'        => 1,
            'description'     => 'A highly skilled software developer with a passion for building scalable applications.',
            'social_links'    => json_encode([
                'linkedin' => 'https://linkedin.com/in/johndoe',
                'github'   => 'https://github.com/johndoe',
                'twitter'  => 'https://twitter.com/johndoe',
            ]),
            'country'         => 'USA',
            'state'           => 'California',
            'postal_code'     => 90001,
        ]);
    }
}
