<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('CreatingAdminGroup');
		$this->call('CreatingAdminUser');
		$this->call('CreatingArticles');
//		$this->call('CreatingAdminUser');
	}

}

class CreatingAdminUser extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'     => 'admin@loc.com',
                'password'  => 'admin',
                'activated' => true,
                'username'  => 'admin',
            ));

            // Find the group using the group id
            $adminGroup = Sentry::findGroupByName('Admin');

            // Assign the group to the user
            $user->addGroup($adminGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            echo 'Password field is required.';
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            echo 'User with this login already exists.';
        }
        catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            echo 'Group was not found.';
        }

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'     => 'user1@loc.com',
                'password'  => 'user1',
                'activated' => true,
                'username'  => 'user1',
            ));

            // Find the group using the group id
            $adminGroup = Sentry::findGroupByName('User');

            // Assign the group to the user
            $user->addGroup($adminGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            echo 'Password field is required.';
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            echo 'User with this login already exists.';
        }
        catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            echo 'Group was not found.';
        }

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'     => 'user2@loc.com',
                'password'  => 'user2',
                'activated' => true,
                'username'  => 'user2',
            ));

            // Find the group using the group id
            $adminGroup = Sentry::findGroupByName('User');

            // Assign the group to the user
            $user->addGroup($adminGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            echo 'Password field is required.';
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            echo 'User with this login already exists.';
        }
        catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            echo 'Group was not found.';
        }


    }

}

class CreatingAdminGroup extends Seeder {

    public function run()
    {
        DB::table('groups')->delete();

        try
        {
            // Create the group
            $groupAdmin = Sentry::createGroup(array(
                'name'        => 'Admin',
                'permissions' => array(
                    'create' => 1,
                    'delete' => 1,
                    'read' => 1,
                    'update' => 1,
                ),
            ));
        }
        catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
        {
            echo 'Name field is required';
        }
        catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
        {
            echo 'Group already exists';
        }

        try
        {
            // Create the group
            $groupUser = Sentry::createGroup(array(
                'name'        => 'User',
                'permissions' => array(
                    'create' => 1,
                    'delete' => 0,
                    'read' => 1,
                    'update' => 0,
                ),
            ));
        }
        catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
        {
            echo 'Name field is required';
        }
        catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
        {
            echo 'Group already exists';
        }

    }

}
>>>>>>> bc6b952471abf6d956c5465f254446f4d2e438dd
