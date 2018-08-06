برای رمز ایجاد رمز جدید روی لینک کلیک کنید: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
