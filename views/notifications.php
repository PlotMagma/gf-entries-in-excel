<?php

use GFExcel\Action\NotificationsAction;
use GFExcel\GFExcel;
use GFExcel\Notification\Exception\NotificationException;

/**
 * Template that renders the notifications.
 * @since $ver$
 */
if (!$this instanceof NotificationsAction) {
    return;
}

try {
    $notifications = $this->getNotifications();
} catch (NotificationException $e) {
    $notifications = [];
}

foreach ($notifications as $notification):
    $dismissible = $notification->isDismissible() ? ' is-dismissible' : null;
    ?>
    <div <?php if ($dismissible) { ?>
        data-gfexcel-notification="<?php echo esc_attr($notification->getId()); ?>"
        data-gfexcel-nonce="<?php echo wp_create_nonce(NotificationsAction::KEY_NONCE); ?>"
    <?php } ?>
            class="notice<?php echo $dismissible; ?> notice-<?php echo $notification->getType(); ?>">
        <p>
            <strong><?php _e('Gravity Forms Entries in Excel', GFExcel::$slug); ?></strong><br/>
            <?php _e($notification->getMessage(), GFExcel::$slug); ?>
        </p>
    </div>
<?php endforeach;
