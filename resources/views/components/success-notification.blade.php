<div
    class="success-notification hide"
    id="successNotification"
    data-auto-show="{{ session('success') ? 'true' : 'false' }}"
>
    <img src="{{ asset('images/icons/success.svg') }}" alt="">
    <div class="success-text">
        <span>Success</span>
        <p id="successNotificationText">{{ session('success') }}</p>
    </div>
    <button type="button" class="close-notification" id="closeSuccessNotification">
        <img src="{{ asset('images/icons/close.svg') }}" alt="">
    </button>
    <div class="notification-progress" id="notificationProgress"></div>
</div>