<?php

 use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//         DB::table('roles')->insert(array(
//             'slug' => 'tutor',
//             'name' => 'tutor',
//         ));
//
//        $credential = [
//            'email' => 'tutor3@gmail.com',
//            'password' => '123456',
//            'first_name' => 'tutor3',
//            'last_name' => 'tutor3',
//
//        ];
//        $user_act = \Sentinel::registerAndActivate($credential);
//        $role =  \Sentinel::findRoleByName('admin');
//        $role->users()->attach($user_act);

        $products = \App\User::all();
        //Categories that don't have child categories.
        $categories = \App\Model\Category::where('id', '!=', 'sub_category_id')->get();
        foreach ($products as $product) {
            DB::table('category_user')->insert([
                'category_id' => $categories->random()->id,
                'user_id' => $product->id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }

}
