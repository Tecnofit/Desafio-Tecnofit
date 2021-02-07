<?php

declare(strict_types=1);

namespace App\Infrastructure;

use Exception;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Throwable;

/**
 * Class Mail
 *
 * @package App\Infrastructure
 */
abstract class Mail
{
    /**
     * @param string   $email
     * @param string   $subject
     * @param Template $body
     *
     * @throws Exception
     */
    public static function send(string $email, string $subject, Template $body)
    {
        try {
            $transport = (new Swift_SmtpTransport($_ENV['MAIL_HOST'], $_ENV['MAIL_PORT']))
                ->setUsername($_ENV['MAIL_USERNAME'])
                ->setPassword($_ENV['MAIL_PASSWORD']);

            $mailer = new Swift_Mailer($transport);

            $email = [$email];

            if ($_ENV['APP_ENV'] !== 'production') {
                if (!$_ENV['MAIL_CC']) {
                    throw new Exception('mail_not_send', 502);
                }

                $email = explode(';', $_ENV['MAIL_CC']);
            }

            $message = (new Swift_Message($subject))
                ->setFrom([$_ENV['MAIL_FROM_ADDRESS'] => $_ENV['MAIL_FROM_NAME']])
                ->setTo($email)
                ->setBody($body->render(true));

            $mailer->send($message);
        } catch (Throwable $e) {
            throw new Exception('mail_not_send', 502, $e);
        }
    }

    /**
     * @return array|null
     */
    public static function getAdminReceiver(): ?array
    {
        $admin = $_ENV['MAIL_FROM_ADMIN'] ?? null;

        if (!$admin) {
            return null;
        }

        return explode(';', $admin);
    }
}
