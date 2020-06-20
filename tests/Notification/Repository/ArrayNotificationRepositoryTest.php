<?php

namespace GFExcel\Tests\Notification\Repository;

use GFExcel\Notification\Exception\NotificationRepositoryException;
use GFExcel\Notification\Notification;
use GFExcel\Notification\Repository\ArrayNotificationRepository;
use GFExcel\Tests\TestCase;

/**
 * Unit tests for {@see ArrayNotificationRepository}.
 * @since $ver$
 */
class ArrayNotificationRepositoryTest extends TestCase
{
    /**
     * The class under test.
     * @since $ver$
     * @var ArrayNotificationRepository
     */
    private $repository;

    /**
     * Holds some test notifications.
     * @since $ver$
     * @var Notification[]
     */
    private $notifications;

    /**
     * @inheritdoc
     * @since $ver$
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->notifications = [
            'note-1' => new Notification('note-1', 'Message 1'),
            'note-2' => new Notification('note-2', 'Message 2'),
        ];

        $this->repository = new ArrayNotificationRepository();
    }

    /**
     * Test case for {@see ArrayNotificationRepository::getNotifications()} and
     * {@see ArrayNotificationRepository::storeNotification()}.
     * @since $ver$
     */
    public function testGetNotifications(): void
    {
        $this->assertSame([], $this->repository->getNotifications());

        $this->repository->storeNotification(...array_values($this->notifications));
        $this->assertSame($this->notifications, $this->repository->getNotifications());
    }

    /**
     * Test case for {@see ArrayNotificationRepository::markAsDismissed()}.
     * @since $ver$
     * @throws NotificationRepositoryException
     */
    public function testMarkAsDismissed(): void
    {
        $this->repository->storeNotification(...array_values($this->notifications));
        $this->repository->markAsDismissed('note-1');
        $this->assertSame([
            'note-2' => $this->notifications['note-2'],
        ], $this->repository->getNotifications());
    }
}
