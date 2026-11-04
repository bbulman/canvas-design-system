<?php
/**
 * Recipe: filtered workshop list.
 *
 * Needs includes/components/helpers.php and includes/components/components.css,
 * which styles the layout helpers. $state is
 * default | loading | empty | error. The arrays are fixtures: a real page reads
 * the caller's own plans (WHERE user_id = ?) and passes the chosen filters back
 * as `value` and `activeChips`.
 */
$state = $state ?? 'default';

$workshops = [
    ['title' => 'Quarterly planning offsite', 'duration' => '3 hours', 'category' => 'Strategy', 'href' => '#plan-101'],
    ['title' => 'Sprint retrospective', 'duration' => '60 min', 'category' => 'Retrospective', 'href' => '#plan-102'],
    ['title' => 'New team kickoff', 'duration' => '90 min', 'category' => 'Team building', 'href' => '#plan-103'],
];
$filtered = $state === 'empty';

// ws_filter_bar uses each label as the select's empty "any" option, so the lists hold real values only.
$filters = [
    ['name' => 'category', 'label' => 'Category', 'value' => $filtered ? 'energiser' : '', 'options' => [
        'strategy' => 'Strategy', 'retrospective' => 'Retrospective', 'team' => 'Team building', 'energiser' => 'Energiser',
    ]],
    ['name' => 'length', 'label' => 'Length', 'value' => '', 'options' => [
        'short' => 'Under an hour', 'half' => 'Half a day', 'day' => 'A full day',
    ]],
];
?>
<?php ws_stack_start(['gap' => '5']) ?>
    <?= ws_section_header('Your workshops', [
        'tag' => 'h2',
        'align' => 'left',
        'id' => 'your-workshops',
        'description' => 'Filter by category or length to find the one you want to run next.',
    ]) ?>

    <?= ws_filter_bar($filters, [
        'search' => ['placeholder' => 'Search your workshops', 'name' => 'q'],
        'activeChips' => $filtered ? [['label' => 'Energiser', 'name' => 'category', 'value' => 'energiser']] : [],
    ]) ?>

    <?php // The count is page content after a reload, read in order; live is only for a count a script changes in place. ?>
    <?php if ($state === 'default' || $state === 'empty'): ?>
        <?= ws_text($filtered ? 'Showing 0 of 3 workshops' : '3 workshops', ['variant' => 'caption']) ?>
    <?php endif; ?>

    <?php if ($state === 'loading'): ?>
        <p class="ws-visually-hidden" role="status">Loading your workshops</p>
        <?php // The placeholders sit in the same grid as the cards, so nothing moves when the cards arrive. ?>
        <?php ws_grid_start() ?>
            <?= ws_skeleton(['variant' => 'workshop', 'count' => 3]) ?>
        <?php ws_grid_end() ?>

    <?php elseif ($state === 'error'): ?>
        <?= ws_alert('Your filters are kept. Try again in a moment.', [
            'variant' => 'error',
            'title' => 'Your workshops did not load',
            'actions' => [['text' => 'Try again', 'href' => '#your-workshops']],
        ]) ?>

    <?php elseif ($state === 'empty'): ?>
        <?= ws_empty_state('No workshops match these filters', [
            'description' => 'Search for a different word, or widen a filter.',
            'icon' => 'search_off',
            'action' => 'Show all workshops',
            'actionHref' => '?',
            'actionVariant' => 'secondary',
        ]) ?>

    <?php else: ?>
        <?php ws_grid_start(['tag' => 'ul']) ?>
            <?php foreach ($workshops as $workshop): ?>
                <li>
                    <?php ws_card_start(['variant' => 'content', 'bordered' => true]) ?>
                        <?php ws_stack_start(['gap' => '3']) ?>
                            <?= ws_text($workshop['title'], ['variant' => 'title']) ?>
                            <?php ws_cluster_start(['gap' => '2']) ?>
                                <?= ws_duration($workshop['duration']) ?>
                                <?= ws_category($workshop['category']) ?>
                            <?php ws_cluster_end() ?>
                            <?= ws_button('Open', ['variant' => 'secondary', 'size' => 'sm', 'href' => $workshop['href'],
                                // Three links all read "Open" out of context (a screen reader's links list), so each names its workshop.
                                'attrs' => ['aria-label' => 'Open ' . $workshop['title']]]) ?>
                        <?php ws_stack_end() ?>
                    <?php ws_card_end() ?>
                </li>
            <?php endforeach; ?>
        <?php ws_grid_end() ?>
    <?php endif; ?>
<?php ws_stack_end() ?>
