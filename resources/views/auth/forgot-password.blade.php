<div>
<form method="POST" action="{{ route('forgot-password.sendOtp') }}">
    @csrf
    <input type="email" name="email" placeholder="Enter your email" required>
    <button type="submit">Send OTP</button>
</form>

</div>
