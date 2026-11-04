<?php
/**
 * Recipe: settings form.
 *
 * Needs includes/components/helpers.php and includes/components/components.css,
 * which styles the layout helpers. $state is
 * default | loading | empty | error. $saved is a fixture: a real page loads the
 * caller's own settings row and posts back to an endpoint that re-checks
 * ownership and a CSRF token.
 */
$state = $state ?? 'default';

$saved = $state === 'empty' ? [] : [
    'workshop_length' => '90',
    'reminder_email' => 'facilitator@example.com',
    'send_reminders' => true,
];
$errors = $state === 'error' ? ['reminder_email' => 'Enter an email address like name@example.com.'] : [];
$lengths = ['60' => '60 minutes', '90' => '90 minutes', '180' => 'Half a day', '480' => 'A full day'];
?>
<?php ws_stack_start(['gap' => '5']) ?>
    <?= ws_section_header('Workshop defaults', [
        'tag' => 'h2',
        'align' => 'left',
        'description' => 'New workshops start with these. You can change any of them per workshop.',
    ]) ?>

    <?php if ($state === 'loading'): ?>
        <p class="ws-visually-hidden" role="status">Loading your settings</p>
        <?php ws_card_start(['variant' => 'content', 'bordered' => true]); ?>
            <?php ws_stack_start(['gap' => '5']) ?>
                <?= ws_skeleton(['variant' => 'input']) ?>
                <?= ws_skeleton(['variant' => 'input']) ?>
                <?= ws_skeleton(['variant' => 'button']) ?>
            <?php ws_stack_end() ?>
        <?php ws_card_end(); ?>
        <?php ws_card_start(['variant' => 'content', 'bordered' => true]); ?>
            <?= ws_skeleton(['variant' => 'text', 'lines' => 2]) ?>
        <?php ws_card_end(); ?>

    <?php else: ?>
        <?php if ($errors): ?>
            <?= ws_alert('Fix the highlighted field, then save again. Nothing else was lost.', [
                'variant' => 'error',
                'title' => 'Your settings were not saved',
            ]) ?>
        <?php elseif (!$saved): ?>
            <?= ws_alert('Nothing is saved yet. Choose your defaults and save them once.', [
                'variant' => 'info',
            ]) ?>
        <?php endif; ?>

        <?php ws_card_start(['variant' => 'content', 'bordered' => true]); ?>
            <?php ws_stack_start(['tag' => 'form', 'gap' => '5', 'attrs' => ['method' => 'post', 'action' => '#settings']]) ?>
                <?= ws_select('workshop_length', $lengths, [
                    'label' => 'Default length',
                    'value' => $saved['workshop_length'] ?? '',
                    'placeholder' => 'Choose a length',
                ]) ?>
                <?= ws_input('reminder_email', [
                    'type' => 'email',
                    'label' => 'Send reminders to',
                    'value' => $state === 'error' ? 'facilitator@example' : ($saved['reminder_email'] ?? ''),
                    'placeholder' => 'name@example.com',
                    'hint' => 'We email you the day before each workshop.',
                    'error' => $errors['reminder_email'] ?? null,
                    'autocomplete' => 'email',
                ]) ?>
                <?php // DESIGN.md 11.6: the primary action leads, aligned left with the fields. ?>
                <?php ws_cluster_start() ?>
                    <?= ws_button('Save settings', ['type' => 'submit']) ?>
                    <?= ws_button('Cancel', ['variant' => 'ghost', 'href' => '#settings']) ?>
                <?php ws_cluster_end() ?>
            <?php ws_stack_end() ?>
        <?php ws_card_end(); ?>

        <?php // A switch must take effect when flipped, so it sits outside the form: a real page posts it on change and confirms with wsToast(). ?>
        <?php ws_card_start(['variant' => 'content', 'bordered' => true]); ?>
            <?= ws_toggle('send_reminders', [
                'label' => 'Email me a reminder',
                'description' => 'Changes as soon as you flip it. Turn it off if your calendar already reminds you.',
                'checked' => $saved['send_reminders'] ?? false,
            ]) ?>
        <?php ws_card_end(); ?>
    <?php endif; ?>
<?php ws_stack_end() ?>
