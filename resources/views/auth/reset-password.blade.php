<div>
<form method="POST" action="{{ route('reset-password.reset') }}">
    @csrf
    <input type="password" name="password" placeholder="Enter new password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm new password" required>
    <button type="submit">Reset Password</button>
</form>

</div>
