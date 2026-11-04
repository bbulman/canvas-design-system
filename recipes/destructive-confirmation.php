<?php
/**
 * Recipe: confirm before a destructive action.
 *
 * Needs includes/components/helpers.php, includes/components/components.js
 * (data-modal-open and data-modal-close) and includes/components/components.css,
 * which styles the layout helpers. $state is default | loading | empty | error.
 * $workshop is a fixture: the real delete re-checks ownership server-side
 * (WHERE id = ? AND user_id = ?) and only then removes anything.
 */
$state = $state ?? 'default';

$workshop = $state === 'empty' ? null : [
    'title' => 'Leadership offsite 2026',
    'items' => 14,
    'updated' => '28 September 2026',
];
$busy = $state === 'loading';
?>
<?php ws_stack_start(['gap' => '5']) ?>
    <?php if (!$workshop): ?>
        <?= ws_empty_state('No workshop selected', [
            'description' => 'Choose a workshop from your list. Delete appears once one is selected.',
            'icon' => 'inbox',
        ]) ?>
        <?= ws_button('Delete workshop', ['variant' => 'danger', 'icon' => 'delete', 'disabled' => true]) ?>

    <?php else: ?>
        <?= ws_card(
            ws_text($workshop['title'], ['variant' => 'title'])
            . '<p>' . (int) $workshop['items'] . ' agenda items, last edited ' . htmlspecialchars($workshop['updated']) . '.</p>'
            . ws_button('Delete workshop', ['variant' => 'danger', 'icon' => 'delete', 'attrs' => ['data-modal-open' => 'confirm-delete']]),
            ['variant' => 'content', 'bordered' => true]
        ) ?>

        <?php
        $body = '';
        if ($state === 'error') {
            $body .= ws_alert('The workshop is still here. Check your connection and try again.', [
                'variant' => 'error',
                'title' => 'Delete did not finish',
            ]);
        }
        $body .= '<p>Delete <strong>' . htmlspecialchars($workshop['title']) . '</strong> and its '
               . (int) $workshop['items'] . ' agenda items? This cannot be undone.</p>';
        // ws_modal_footer forwards attrs, not loading or disabled, so the busy state sets them as attributes.
        $body .= ws_modal_footer([
            'cancel' => ['text' => 'Keep workshop', 'attrs' => $busy ? ['disabled' => 'disabled'] : ['data-modal-close' => 'confirm-delete']],
            'primary' => [
                'text' => $busy ? 'Deleting' : ($state === 'error' ? 'Try again' : 'Delete workshop'),
                'variant' => 'danger',
                'icon' => 'delete',
                'attrs' => $busy ? ['disabled' => 'disabled', 'aria-busy' => 'true'] : [],
            ],
        ]);
        echo ws_modal($body, [
            'id' => 'confirm-delete',
            'title' => 'Delete this workshop?',
            'size' => 'sm',
            'closable' => !$busy,
            'backdrop' => !$busy,
        ]);
        ?>
    <?php endif; ?>
<?php ws_stack_end() ?>
