<form id="formAuthentication" class="mb-3" wire:submit.prevent="signIn">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error("email") is-invalid @enderror" id="email"
               wire:model="email" placeholder="Enter your email" autofocus >
        @error('email') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3 form-password-toggle">
        <label class="form-label" for="password">Password</label>
        <div class="input-group input-group-merge">
            <input type="password" id="password"
                   class="form-control @error("password") is-invalid @enderror" wire:model="password"
                   placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                   aria-describedby="password"/>
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
        @error('password') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember-me" wire:model="rememberMe">
            <label class="form-check-label" for="remember-me">
                Remember Me
            </label>
        </div>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
    </div>
</form>
