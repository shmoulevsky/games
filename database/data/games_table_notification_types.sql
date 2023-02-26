
INSERT INTO `notification_types` (`id`, `created_at`, `updated_at`, `name`, `handler`, `type`, `groups`, `variables`) VALUES
(1, '2022-05-11 23:06:15', '2022-05-11 23:06:15', 'RegisterConfirm', 'RegisterConfirmEvent', 'event', '[]', '[\"name\", \"link\"]'),
(2, '2022-05-11 23:06:15', '2022-05-11 23:06:15', 'SubscriptionEndEvent', 'SubscriptionEndEvent', 'interval', '[]', '[\"date\", \"email\", \"name\", \"comment\", \"title\", \"url\", \"domain\"]');
