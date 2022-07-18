{{ !empty($user['first_name']) ? Str::title($user['first_name'].' '.$user['last_name']) : 'Unavailable' }}
