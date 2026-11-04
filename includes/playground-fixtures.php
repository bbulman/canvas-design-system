<?php
/**
 * Playground fixtures: database-free examples of the ws_* helpers. The same
 * arguments render the preview and print the copyable PHP.
 *
 * A curated fixture calls `helper` with its positional `args`, then the options
 * array unless `options` is null (a helper that takes none). Optional fields:
 *   text      index of the argument the "Preview text" control edits
 *   html      'p' when that argument is an HTML slot the edited text fills as one
 *             escaped paragraph, 'inline' when it is escaped without one
 *   choices   the only values a request may set for an option
 *   editable  options a request may set to free text. Each must be one the
 *             helper escapes; playground.spec.js sends markup through every one.
 *   states    option overrides per state; null removes the option
 *   stateArgs argument overrides per state, by index
 *   before    calls or HTML rendered ahead of the helper, such as the ws_tabs row a panel needs
 *   frame     'pair': the helper opens a block that `body` fills and `close`
 *             ends. 'modal': the call follows `body` inside ws_modal_start(`modal`).
 *   body      HTML strings and dsPlaygroundCall() values, in order
 *   trigger   [button text, modal id]: a button that opens the modal
 *   opens     the modal id the preview opens on load
 *   toasts    per state, [message, variant, action label] for each wsToast() call
 *   covers    other helpers this fixture previews (a block's closing helper)
 *   after     dsPlaygroundCall() values rendered after the helper (a toast container it needs)
 *   script    a script under js/ the component's behaviour needs, loaded after components.js
 *
 * A helper with no curated fixture gets an auto preview (dsPlaygroundAutoFixture)
 * unless dsPlaygroundSkipReason() says why it cannot render here.
 */
function dsPlaygroundFixtures(): array
{
    return [
        'button' => ['helper' => 'ws_button', 'args' => ['Save workshop'], 'text' => 0, 'options' => ['variant' => 'primary', 'size' => 'md', 'disabled' => false, 'loading' => false], 'choices' => ['variant' => ['primary', 'secondary', 'ghost', 'danger'], 'size' => ['sm', 'md', 'lg']], 'states' => ['default' => [], 'disabled' => ['disabled' => true], 'loading' => ['loading' => true]]],
        'input' => ['helper' => 'ws_input', 'args' => ['workshop-title'], 'options' => ['label' => 'Workshop title', 'hint' => 'Give your workshop a name.', 'error' => '', 'required' => false, 'disabled' => false], 'editable' => ['label', 'hint', 'error'], 'states' => ['default' => [], 'error' => ['error' => 'Enter a workshop title.', 'required' => true], 'disabled' => ['disabled' => true]]],
        'card' => ['helper' => 'ws_card', 'args' => ['<h3>Product planning</h3><p>A two-hour workshop for the product team.</p>'], 'text' => 0, 'html' => 'p', 'options' => ['variant' => 'content', 'hoverable' => false], 'choices' => ['variant' => ['content', 'feature', 'compact', 'flush']], 'states' => ['default' => [], 'hoverable' => ['hoverable' => true]]],
        'empty-state' => ['helper' => 'ws_empty_state', 'args' => ['No workshops yet'], 'text' => 0, 'options' => ['description' => 'Your saved workshops will appear here.', 'icon' => 'event_note'], 'choices' => ['icon' => ['event_note', 'search']], 'editable' => ['description'], 'states' => ['default' => [], 'no-results' => ['description' => 'Try a different search.', 'icon' => 'search'], 'with-action' => ['description' => 'Start from a template and you can run it this week.', 'action' => 'Plan a workshop', 'actionHref' => '/app/?view=plan']], 'stateArgs' => ['no-results' => ['No workshops found']]],
        'modal' => ['helper' => 'ws_modal', 'args' => ['<p>Review the workshop details before continuing.</p>'], 'text' => 0, 'html' => 'p', 'options' => ['id' => 'playground-modal', 'title' => 'Workshop details', 'size' => 'default'], 'choices' => ['size' => ['sm', 'default', 'lg', 'xl', 'full']], 'editable' => ['title'], 'trigger' => ['Open preview', 'playground-modal'], 'states' => ['default' => [], 'large' => ['size' => 'lg']]],
        'select' => [
            'helper' => 'ws_select',
            'args' => ['workshop-length', ['90' => '90 minutes', '120' => '2 hours', '240' => 'Half day', '480' => 'Full day']],
            'options' => ['label' => 'Workshop length', 'placeholder' => 'Choose a length', 'helper' => 'Sets how much time the planner fills.', 'error' => '', 'required' => false, 'disabled' => false, 'size' => 'md'],
            'choices' => ['size' => ['sm', 'md', 'lg']],
            'editable' => ['label', 'placeholder', 'helper', 'error'],
            'states' => ['default' => [], 'selected' => ['value' => '240'], 'error' => ['error' => 'Choose how long the workshop runs.', 'required' => true], 'disabled' => ['value' => '120', 'disabled' => true]],
        ],
        'badge' => [
            'helper' => 'ws_badge',
            'args' => ['Hybrid'],
            'text' => 0,
            'options' => ['variant' => 'default', 'size' => 'md', 'pill' => false],
            'choices' => ['variant' => ['default', 'duration', 'category', 'status', 'count', 'new', 'ai'], 'size' => ['sm', 'md', 'lg']],
            'states' => ['default' => [], 'count' => ['variant' => 'count'], 'new' => ['variant' => 'new'], 'pill' => ['pill' => true], 'ai' => ['variant' => 'ai']],
            'stateArgs' => ['count' => ['3'], 'new' => ['New'], 'ai' => ['Prepared by Workshopr']],
        ],
        'icon-button' => [
            'helper' => 'ws_icon_button',
            'args' => ['more_horiz'],
            'options' => ['variant' => 'ghost', 'size' => 'sm', 'attrs' => ['aria-label' => 'More actions for Quarterly planning offsite']],
            'choices' => ['variant' => ['primary', 'secondary', 'ghost', 'danger'], 'size' => ['sm', 'md', 'lg']],
            'states' => ['default' => [], 'close' => ['attrs' => ['aria-label' => 'Close panel']], 'secondary' => ['variant' => 'secondary']],
            'stateArgs' => ['close' => ['close']],
        ],
        'skeleton' => [
            'helper' => 'ws_skeleton',
            'options' => ['variant' => 'text', 'lines' => 3],
            'choices' => ['variant' => ['text', 'avatar', 'image', 'card', 'workshop', 'button', 'input']],
            'states' => ['default' => [], 'card' => ['variant' => 'card', 'lines' => null], 'avatar' => ['variant' => 'avatar', 'lines' => null, 'size' => 'lg'], 'workshop-grid' => ['variant' => 'workshop', 'lines' => null, 'count' => 3, 'grid' => true]],
        ],
        'feature-card' => [
            'helper' => 'ws_feature_card',
            'args' => ['Drag-and-drop planner', "Build the agenda block by block. The break rule and the day's end show as you go."],
            'text' => 0,
            'options' => ['icon' => 'view_timeline', 'variant' => 'default'],
            'choices' => ['icon' => ['view_timeline', 'fact_check', 'event_available'], 'variant' => ['default', 'compact', 'coming-soon']],
            'states' => ['default' => [], 'compact' => ['variant' => 'compact'], 'coming-soon' => ['variant' => 'coming-soon', 'icon' => 'event_available']],
            'stateArgs' => ['coming-soon' => ['Calendar holds', 'Send every attendee the agenda with a hold for the room.']],
        ],
        'form-row' => [
            'helper' => 'ws_form_row',
            'args' => [dsPlaygroundCall('ws_input', ['workshop-goal', ['placeholder' => 'Leave with a ranked list of Q4 bets']])],
            'options' => ['label' => 'What should the group leave with?', 'helper' => 'One sentence. The planner uses it to pick exercises.', 'error' => '', 'required' => true, 'inline' => false],
            'editable' => ['label', 'helper', 'error'],
            'states' => ['default' => [], 'error' => ['error' => 'Say what the group should leave with.'], 'inline' => ['inline' => true]],
        ],
        'section-header' => [
            'helper' => 'ws_section_header',
            'args' => ['Plan the session'],
            'text' => 0,
            'options' => ['subtitle' => 'before the room fills up.', 'description' => 'Pick a goal, choose the exercises and walk in with an agenda that fits the time you have.', 'label' => 'Plan', 'align' => 'center', 'tag' => 'h2'],
            'choices' => ['align' => ['left', 'center'], 'tag' => ['h2', 'h3']],
            'editable' => ['subtitle', 'description', 'label'],
            'states' => ['default' => [], 'left' => ['align' => 'left']],
        ],
        'modal-footer' => [
            'helper' => 'ws_modal_footer',
            'frame' => 'modal',
            'modal' => ['id' => 'send-agenda', 'title' => 'Send the agenda', 'size' => 'sm'],
            'body' => ['<p>Everyone on the invite list gets the agenda and a hold in their calendar.</p>'],
            'trigger' => ['Send agenda', 'send-agenda'],
            'opens' => 'send-agenda',
            'options' => ['cancel' => ['text' => 'Cancel', 'attrs' => ['data-modal-close' => 'send-agenda']], 'primary' => ['text' => 'Send agenda', 'icon' => 'send']],
            'states' => ['default' => [], 'with-left' => ['left' => ['text' => 'Download .ics', 'icon' => 'download', 'variant' => 'ghost']], 'single' => ['cancel' => null, 'primary' => ['text' => 'Send agenda', 'icon' => 'send', 'fullWidth' => true]]],
        ],
        'modal-start' => [
            'helper' => 'ws_modal_start',
            'covers' => ['ws_modal_end'],
            'frame' => 'pair',
            'close' => 'ws_modal_end',
            'body' => [
                dsPlaygroundCall('ws_input', ['workshop-name', ['label' => 'Workshop name', 'value' => 'Quarterly planning offsite', 'hint' => 'Everyone working on this workshop sees the new name.', 'required' => true]]),
                dsPlaygroundCall('ws_modal_footer', [['cancel' => ['text' => 'Cancel', 'attrs' => ['data-modal-close' => 'rename-workshop']], 'primary' => ['text' => 'Save name', 'icon' => 'check']]]),
            ],
            'trigger' => ['Rename workshop', 'rename-workshop'],
            'opens' => 'rename-workshop',
            'options' => ['id' => 'rename-workshop', 'title' => 'Rename this workshop', 'size' => 'sm', 'variant' => 'default'],
            'choices' => ['size' => ['sm', 'default', 'lg', 'xl', 'full'], 'variant' => ['default', 'drawer', 'bottom-sheet', 'branded']],
            'editable' => ['title'],
            'states' => ['default' => [], 'branded' => ['variant' => 'branded', 'size' => 'default', 'icon' => 'edit', 'subtitle' => 'Everyone working on this workshop sees the new name.'], 'drawer' => ['variant' => 'drawer'], 'bottom-sheet' => ['variant' => 'bottom-sheet']],
        ],
        'card-start' => [
            'helper' => 'ws_card_start',
            'covers' => ['ws_card_end'],
            'frame' => 'pair',
            'close' => 'ws_card_end',
            'body' => ['<h3>Quarterly planning offsite</h3>', "<p>Two days, 14 people and one decision about next year's roadmap.</p>", dsPlaygroundCall('ws_duration', ['2 days'])],
            'options' => ['variant' => 'content', 'hoverable' => false, 'elevated' => false, 'bordered' => false],
            'choices' => ['variant' => ['content', 'feature', 'compact', 'flush']],
            'states' => ['default' => [], 'bordered' => ['bordered' => true], 'elevated' => ['elevated' => true]],
        ],
        'agenda' => [
            'helper' => 'ws_agenda',
            'args' => [[
                ['title' => 'Welcome and goals', 'duration' => 10, 'type' => 'custom'],
                ['title' => 'Two truths and a lie', 'duration' => 15, 'type' => 'icebreaker'],
                ['title' => 'Dot voting on the roadmap', 'duration' => 30, 'type' => 'exercise', 'description' => 'Silent first, then discuss the top five.'],
                ['title' => 'Coffee', 'duration' => 15, 'type' => 'break'],
                ['title' => 'Owners and first steps', 'duration' => 20, 'type' => 'exercise'],
            ]],
            'options' => ['start' => '09:30', 'label' => 'Morning agenda'],
            'editable' => ['start', 'label'],
            'states' => ['default' => [], 'no-times' => ['start' => null], 'live' => ['start' => null, 'label' => 'Running order', 'live' => true]],
            'stateArgs' => ['live' => [[
                ['title' => 'Welcome and goals', 'start' => '09:30', 'duration' => 10, 'type' => 'custom', 'state' => 'done', 'actual' => 12],
                ['title' => 'Two truths and a lie', 'start' => '09:42', 'duration' => 15, 'type' => 'icebreaker', 'state' => 'done', 'actual' => 15],
                ['title' => 'Dot voting on the roadmap', 'start' => '09:57', 'duration' => 30, 'type' => 'exercise', 'state' => 'now'],
                ['title' => 'Coffee', 'start' => '10:27', 'planned_start' => '10:25', 'duration' => 15, 'type' => 'break', 'state' => 'next'],
                ['title' => 'Owners and first steps', 'start' => '10:42', 'planned_start' => '10:40', 'duration' => 18, 'type' => 'exercise', 'state' => 'next', 'change' => 'trimmed'],
            ]]],
        ],
        'run-clock' => [
            'helper' => 'ws_run_clock',
            'options' => ['seconds' => 440, 'planned' => 20, 'size' => 'lg'],
            'choices' => ['size' => ['md', 'lg', 'xl']],
            'states' => ['default' => [], 'ending' => ['seconds' => 90], 'over' => ['seconds' => -310], 'paused' => ['state' => 'paused']],
        ],
        'exercise-tile' => [
            'helper' => 'ws_exercise_tile',
            'options' => ['symbol' => 'Af', 'name' => 'Affinity Diagramming', 'minutes' => 20],
            'editable' => ['name'],
            'states' => ['default' => [], 'link' => ['href' => '/library/exercises/detail/?code=affinity'], 'no-minutes' => ['minutes' => null], 'actions' => ['href' => '/library/exercises/detail/?code=affinity', 'actions' => [
                ['icon' => 'swap_horiz', 'label' => 'Swap'],
                ['icon' => 'visibility', 'label' => 'Quick view'],
            ]]],
        ],
        'exercise-formula' => [
            'helper' => 'ws_exercise_formula',
            'args' => [[
                ['symbol' => 'Bw', 'name' => 'Brainwriting', 'minutes' => 20],
                ['symbol' => 'Af', 'name' => 'Affinity Diagramming', 'minutes' => 20],
                ['symbol' => 'Dv', 'name' => 'Dot Voting', 'minutes' => 25],
            ]],
            'options' => ['label' => 'The three exercises, in order'],
            'editable' => ['label'],
            'states' => ['default' => []],
        ],
        'session-shape' => [
            'helper' => 'ws_session_shape',
            'args' => [[
                ['name' => 'Check-in', 'minutes' => 10, 'kind' => 'frame', 'energy' => 2],
                ['name' => 'Reverse Brainstorming', 'minutes' => 25, 'energy' => 4],
                ['name' => 'TRIZ', 'minutes' => 20, 'energy' => 4],
                ['name' => '15% Solutions', 'minutes' => 20, 'energy' => 3],
                ['name' => 'Commit', 'minutes' => 15, 'kind' => 'frame', 'energy' => 1],
            ]],
            'options' => ['label' => 'Shape of the session'],
            'editable' => ['label'],
            'states' => ['default' => [], 'time-only' => ['showEnergy' => false]],
        ],
        'link-switch' => [
            'helper' => 'ws_link_switch',
            'args' => [[['label' => '90 min', 'href' => '?length=90', 'current' => true], ['label' => '60 min', 'href' => '?length=60']]],
            'options' => ['label' => 'Length', 'showLabel' => true],
            'editable' => ['label'],
            'states' => ['default' => [], 'unlabelled' => ['showLabel' => false]],
        ],
        'card-deck' => [
            'helper' => 'ws_card_deck',
            'args' => [[
                ['title' => 'The Naysayer', 'caption' => 'Difficult Participants · 1 of 3', 'icon' => 'support'],
                ['title' => 'The Silent One'],
                ['title' => 'Running Over'],
            ]],
            'options' => ['href' => '#intervention-cards', 'name' => 'Intervention Cards'],
            'editable' => ['name', 'label'],
            'states' => ['default' => [], 'two' => [], 'one' => []],
            'stateArgs' => [
                'two' => [[['title' => 'The Naysayer', 'caption' => 'Difficult Participants · 1 of 2', 'icon' => 'support'], ['title' => 'The Silent One']]],
                'one' => [[['title' => 'Running Over', 'caption' => 'Time Management · 1 of 1', 'icon' => 'support']]],
            ],
        ],
        'form-row-start' => [
            'helper' => 'ws_form_row_start',
            'covers' => ['ws_form_row_end'],
            'frame' => 'pair',
            'close' => 'ws_form_row_end',
            'body' => [
                dsPlaygroundCall('ws_toggle', ['session_reminders', ['label' => 'Session reminders', 'description' => 'The day before a workshop you are running.', 'id' => 'pg-reminders']]),
                dsPlaygroundCall('ws_toggle', ['weekly_digest', ['label' => 'Weekly digest', 'description' => 'New exercises, every Monday.', 'id' => 'pg-digest']]),
            ],
            'options' => ['label' => 'Email me about', 'helper' => 'Each one changes as soon as you switch it.', 'id' => 'pg-notify'],
            'editable' => ['label', 'helper'],
            'states' => ['default' => [], 'error' => ['error' => 'Choose at least one, or turn email off in your account.']],
        ],
        'text' => [
            'helper' => 'ws_text',
            'args' => ['Quarterly planning offsite'],
            'text' => 0,
            'options' => ['variant' => 'title'],
            'choices' => ['variant' => ['title', 'caption']],
            'states' => ['default' => [], 'caption' => ['variant' => 'caption']],
            'stateArgs' => ['caption' => ['Showing 6 of 8 workshops']],
        ],
        'tab-panel-start' => [
            'helper' => 'ws_tab_panel_start',
            'covers' => ['ws_tab_panel_end'],
            'before' => [dsPlaygroundCall('ws_tabs', [[['id' => 'pg-agenda', 'label' => 'Agenda', 'active' => true], ['id' => 'pg-notes', 'label' => 'Notes']], ['id' => 'pg-panel-tabs', 'label' => 'Workshop sections']])],
            'frame' => 'pair',
            'close' => 'ws_tab_panel_end',
            'args' => ['pg-agenda'],
            'body' => [dsPlaygroundCall('ws_agenda', [[['title' => 'Welcome and goals', 'duration' => 10, 'type' => 'custom'], ['title' => 'Dot voting', 'duration' => 30, 'type' => 'exercise'], ['title' => 'Coffee', 'duration' => 15, 'type' => 'break']], ['start' => '09:30', 'label' => 'Morning agenda']])],
            'after' => [
                dsPlaygroundCall('ws_tab_panel_start', ['pg-notes']),
                dsPlaygroundCall('ws_input', ['pg_notes', ['type' => 'textarea', 'label' => 'Your notes']]),
                dsPlaygroundCall('ws_tab_panel_end', []),
            ],
            'options' => [],
            'states' => ['default' => []],
        ],
        'stack-start' => [
            'helper' => 'ws_stack_start',
            'covers' => ['ws_stack_end'],
            'frame' => 'pair',
            'close' => 'ws_stack_end',
            'body' => [
                dsPlaygroundCall('ws_input', ['workshop-title', ['label' => 'Workshop title', 'value' => 'Quarterly planning offsite']]),
                dsPlaygroundCall('ws_input', ['workshop-goal', ['label' => 'What should the group leave with?', 'hint' => 'One sentence. The planner uses it to pick exercises.']]),
                dsPlaygroundCall('ws_button', ['Save workshop', ['type' => 'submit']]),
            ],
            'options' => ['gap' => '5', 'tag' => 'form'],
            'choices' => ['gap' => ['2', '3', '4', '5', '6', '8'], 'tag' => ['div', 'form']],
            'states' => ['default' => [], 'tight' => ['gap' => '2'], 'roomy' => ['gap' => '8']],
        ],
        'cluster-start' => [
            'helper' => 'ws_cluster_start',
            'covers' => ['ws_cluster_end'],
            'frame' => 'pair',
            'close' => 'ws_cluster_end',
            'body' => [
                dsPlaygroundCall('ws_button', ['Save changes', ['type' => 'submit']]),
                dsPlaygroundCall('ws_button', ['Preview agenda', ['variant' => 'secondary']]),
                dsPlaygroundCall('ws_button', ['Cancel', ['variant' => 'ghost']]),
            ],
            'options' => ['gap' => '3', 'justify' => 'start', 'align' => 'center'],
            'choices' => ['gap' => ['2', '3', '4', '6'], 'justify' => ['start', 'center', 'end', 'between'], 'align' => ['start', 'center', 'end', 'baseline', 'stretch']],
            'states' => ['default' => [], 'between' => ['justify' => 'between'], 'end' => ['justify' => 'end']],
        ],
        'grid-start' => [
            'helper' => 'ws_grid_start',
            'covers' => ['ws_grid_end'],
            'frame' => 'pair',
            'close' => 'ws_grid_end',
            'body' => [
                dsPlaygroundCall('ws_card', ['<h3>Quarterly planning offsite</h3><p>Two days, 14 people.</p>']),
                dsPlaygroundCall('ws_card', ['<h3>Team retrospective</h3><p>90 minutes, remote.</p>']),
                dsPlaygroundCall('ws_card', ['<h3>Design sprint kickoff</h3><p>Half day, in person.</p>']),
                dsPlaygroundCall('ws_card', ['<h3>Onboarding workshop</h3><p>Two hours, hybrid.</p>']),
            ],
            'options' => ['min' => 'md', 'gap' => '4'],
            'choices' => ['min' => ['sm', 'md', 'lg'], 'gap' => ['2', '3', '4', '6']],
            'states' => ['default' => [], 'compact' => ['min' => 'sm'], 'wide' => ['min' => 'lg']],
        ],
        'container-start' => [
            'helper' => 'ws_container_start',
            'covers' => ['ws_container_end'],
            'frame' => 'pair',
            'close' => 'ws_container_end',
            'body' => [
                dsPlaygroundCall('ws_section_header', ['Notification settings', ['tag' => 'h2', 'align' => 'left', 'description' => 'Choose which emails Workshopr sends you, and where.']]),
            ],
            'options' => ['width' => 'sm', 'gutter' => true],
            'choices' => ['width' => ['xs', 'sm', 'md', 'lg', 'xl', '2xl']],
            'states' => ['default' => [], 'narrow' => ['width' => 'xs'], 'flush' => ['gutter' => false]],
        ],
        'footer' => [
            'helper' => 'ws_footer',
            'options' => ['hide_level_up' => false],
            'states' => ['default' => [], 'without-level-up' => ['hide_level_up' => true]],
        ],
        'toggle' => [
            'helper' => 'ws_toggle',
            'args' => ['share-notes'],
            'options' => ['id' => 'share-notes', 'label' => 'Share facilitator notes', 'description' => 'Co-facilitators see your notes during the session.', 'checked' => false, 'disabled' => false],
            'editable' => ['label', 'description'],
            'states' => ['default' => [], 'checked' => ['checked' => true], 'disabled' => ['disabled' => true]],
        ],
        'range' => [
            'helper' => 'ws_range',
            'args' => ['break-length'],
            'options' => ['id' => 'break-length', 'label' => 'Break length', 'description' => '15 minutes', 'min' => 5, 'max' => 30, 'step' => 5, 'value' => 15, 'valueText' => '15 minutes', 'disabled' => false],
            'editable' => ['label', 'description'],
            'states' => ['default' => [], 'disabled' => ['disabled' => true]],
        ],
        'tabs' => [
            'helper' => 'ws_tabs',
            'args' => [[['id' => 'agenda', 'label' => 'Agenda', 'active' => true], ['id' => 'materials', 'label' => 'Materials', 'count' => 4], ['id' => 'notes', 'label' => 'Notes'], ['id' => 'report', 'label' => 'Report', 'disabled' => true]]],
            'options' => ['id' => 'workshop-sections', 'label' => 'Workshop sections', 'variant' => 'underline', 'size' => 'md'],
            'choices' => ['variant' => ['underline', 'pill', 'segmented'], 'size' => ['sm', 'md', 'lg']],
            'editable' => ['label'],
            'states' => ['default' => [], 'pill' => ['variant' => 'pill'], 'segmented' => ['variant' => 'segmented']],
        ],
        'alert' => [
            'helper' => 'ws_alert',
            'args' => ['The morning runs 100 minutes straight. Add a 10-minute break or trim the second exercise.'],
            'text' => 0,
            'html' => 'inline',
            'options' => ['variant' => 'warning', 'title' => 'Add a break before 11:00', 'dismissible' => false],
            'choices' => ['variant' => ['info', 'success', 'warning', 'error']],
            'editable' => ['title'],
            'states' => [
                'default' => [],
                'info' => ['variant' => 'info', 'title' => 'Priya can edit this agenda'],
                'success' => ['variant' => 'success', 'title' => 'Agenda saved'],
                'error' => ['variant' => 'error', 'title' => "We couldn't load your workshops"],
                'dismissible' => ['dismissible' => true],
            ],
            'stateArgs' => [
                'info' => ['Changes either of you make save to the same workshop.'],
                'success' => ['Your co-facilitators see the new version now.'],
                'error' => ['Check your connection and try again. Nothing you saved is lost.'],
            ],
        ],
        'filter-bar' => [
            'helper' => 'ws_filter_bar',
            'args' => [[
                ['name' => 'duration', 'label' => 'Duration', 'options' => ['short' => 'Under 30 min', 'medium' => '30 to 60 min', 'long' => 'Over an hour']],
                ['name' => 'group', 'label' => 'Group size', 'options' => ['small' => '2 to 8 people', 'medium' => '9 to 20 people', 'large' => '21 or more']],
            ]],
            'options' => ['search' => ['placeholder' => 'Search exercises', 'value' => ''], 'searchLabel' => 'Search exercises', 'color' => 'learn'],
            'choices' => ['color' => ['learn', 'plan', 'facilitate', 'reflect']],
            'states' => ['default' => [], 'filtered' => ['search' => ['placeholder' => 'Search exercises', 'value' => 'retro'], 'activeChips' => [['label' => 'Under 30 min', 'name' => 'duration', 'value' => 'short']]]],
            'stateArgs' => ['filtered' => [[
                ['name' => 'duration', 'label' => 'Duration', 'options' => ['short' => 'Under 30 min', 'medium' => '30 to 60 min', 'long' => 'Over an hour'], 'value' => 'short'],
                ['name' => 'group', 'label' => 'Group size', 'options' => ['small' => '2 to 8 people', 'medium' => '9 to 20 people', 'large' => '21 or more']],
            ]]],
        ],
        'status' => [
            'helper' => 'ws_status',
            'args' => ['Completed', 'success'],
            'text' => 0,
            'options' => null,
            'states' => ['default' => [], 'draft' => [], 'needs-facilitator' => [], 'failed' => [], 'pro' => []],
            'stateArgs' => ['draft' => ['Draft', 'info'], 'needs-facilitator' => ['Needs a facilitator', 'warning'], 'failed' => ['Sync failed', 'error'], 'pro' => ['Pro', 'gold']],
        ],
        'toast-container' => [
            'helper' => 'ws_toast_container',
            'options' => null,
            'states' => ['default' => [], 'undo' => [], 'error' => []],
            'toasts' => [
                'default' => [['Agenda saved.', 'success', null]],
                'undo' => [['Removed Crazy 8s from the agenda.', 'info', 'Undo']],
                'error' => [["Couldn't save. Check your connection and try again.", 'error', null]],
            ],
        ],
        'ai-mark' => [
            'helper' => 'ws_ai_mark',
            'options' => ['size' => 'md'],
            'choices' => ['size' => ['sm', 'md']],
            'states' => ['default' => [], 'small' => ['size' => 'sm'], 'labelled' => ['label' => 'Made by Workshopr']],
        ],
        'agent-status' => [
            'helper' => 'ws_agent_status',
            'options' => [
                'id' => 'playground-agent-status',
                'mode' => 'stages',
                'label' => 'Building your agenda',
                'stages' => [
                    ['key' => 'brief', 'label' => 'Read the brief', 'state' => 'done', 'detail' => '12 product leaders, 2 hours, one decision to make.'],
                    ['key' => 'recording', 'label' => 'Transcribe the kickoff recording', 'state' => 'failed', 'recovery' => 'The file stopped at 12 minutes. Upload it again, or carry on without it.', 'action' => ['label' => 'Try again']],
                    ['key' => 'pick', 'label' => 'Choose activities from the library', 'state' => 'now'],
                    ['key' => 'check', 'label' => 'Check the timings and the breaks', 'state' => 'todo'],
                ],
            ],
            'choices' => ['mode' => ['thinking', 'stages'], 'size' => ['sm', 'md']],
            'editable' => ['label'],
            'script' => 'js/ws-agent.js',
            'states' => [
                'default' => [],
                'thinking' => ['id' => null, 'mode' => 'thinking', 'label' => 'Working on it', 'stages' => null],
                'thinking-detail' => ['id' => null, 'mode' => 'thinking', 'label' => 'Reading your notes', 'detail' => '14 notes and 2 recordings', 'stages' => null],
                'inline' => ['id' => null, 'mode' => 'thinking', 'size' => 'sm', 'label' => 'Drafting', 'stages' => null],
                'all-done' => ['stages' => [
                    ['key' => 'brief', 'label' => 'Read the brief', 'state' => 'done'],
                    ['key' => 'pick', 'label' => 'Choose activities from the library', 'state' => 'done', 'detail' => '6 activities, 1h 55m.'],
                    ['key' => 'check', 'label' => 'Check the timings and the breaks', 'state' => 'done'],
                ]],
            ],
        ],
        'agent-steps' => [
            'helper' => 'ws_agent_steps',
            'args' => [[
                ['label' => 'Read the brief and Q3 Roadmap Offsite', 'state' => 'done', 'detail' => '5 open commitments become the candidate priorities.'],
                ['label' => 'Built a first agenda from 7 library activities', 'state' => 'done'],
                ['label' => 'Round 1: 2 of 7 checks failed', 'state' => 'fail', 'detail' => 'The decision had 8 minutes. Choosing 3 of 12 with 12 people needs about 24.'],
                ['label' => 'Revised', 'state' => 'done', 'icon' => 'auto_fix_high', 'detail' => 'Swapped Crazy 8s for 1-2-4-All and gave the decision 30 minutes.'],
                ['label' => 'Checking again', 'state' => 'now'],
                ['label' => 'Write the pre-read and your notes', 'state' => 'todo'],
            ]],
            'options' => ['label' => 'What Workshopr did', 'summary' => ['label' => 'Rounds', 'value' => '2 of 3']],
            'editable' => ['label'],
            'states' => ['default' => [], 'no-summary' => ['summary' => null]],
        ],
        'agent-check' => [
            'helper' => 'ws_agent_check',
            'args' => [[
                ['title' => 'Fits 2 hours', 'state' => 'pass', 'detail' => '1h 55m, inside the 12% allowance. No stretch over 90 minutes without a break.'],
                ['title' => 'Works for 12 people', 'state' => 'warn', 'detail' => 'Two Truths and a Bet lists "any size". Fine, but it runs long past 15.'],
                ['title' => 'Serves the outcome', 'state' => 'fail', 'detail' => 'The decision has 8 minutes. Choosing 3 of 12 with 12 people needs about 24.'],
                ['title' => 'Materials', 'state' => 'pass', 'detail' => 'A pre-read, and notes for every item.'],
            ]],
            'options' => ['label' => 'Checks this agenda was held to'],
            'editable' => ['label'],
            'states' => ['default' => [], 'all-pass' => []],
            'stateArgs' => ['all-pass' => [[
                ['title' => 'Fits 2 hours', 'state' => 'pass', 'detail' => '1h 55m, inside the 12% allowance.'],
                ['title' => 'Works for 12 people', 'state' => 'pass', 'detail' => 'Every activity is written for 8 to 20.'],
            ]]],
        ],
        'agent-proposal' => [
            'helper' => 'ws_agent_proposal',
            'options' => [
                'id' => 'playground-proposal',
                'title' => 'Still end at 11:00, and keep the full decision',
                'changes' => [
                    ['at' => '9:55', 'label' => 'Break', 'was' => '15m', 'new' => '5m'],
                    ['at' => '10:12', 'label' => 'Restate the question', 'new' => 'New, 3m'],
                    ['at' => '10:45', 'label' => 'Commit: owners and first steps', 'was' => '20m', 'new' => '15m'],
                ],
                'why' => 'You are 12 minutes behind, and three people asked which question they are answering. Restating it costs 3 minutes; the break and the close pay for it.',
                'apply' => 'Apply to the session',
                'adjust' => 'Adjust',
            ],
            'editable' => ['title', 'why'],
            'after' => [dsPlaygroundCall('ws_toast_container', [])],
            'script' => 'js/ws-agent.js',
            'states' => [
                'default' => [],
                'no-adjust' => ['adjust' => null],
                'removed' => ['title' => 'Make room for the decision', 'changes' => [
                    ['label' => 'Lightning Demos', 'removed' => true],
                    ['label' => 'Dot voting', 'was' => '10m', 'new' => '25m'],
                ], 'why' => 'The decision needs about 24 minutes for 12 people choosing 3 of 12.'],
                'rules' => ['source' => 'rules', 'kicker' => 'From your agenda rules', 'adjust' => null],
            ],
        ],
        'source-chip' => [
            'helper' => 'ws_source_chip',
            'args' => ['Your note 10:31'],
            'text' => 0,
            'options' => ['kind' => 'note', 'href' => '#note-42', 'unlinked' => false],
            'choices' => ['kind' => ['note', 'recording', 'photo', 'document', 'board', 'poll']],
            'states' => ['default' => [], 'recording' => ['kind' => 'recording', 'href' => '#recording-1'], 'poll' => ['kind' => 'poll', 'href' => '#poll-3'], 'unlinked' => ['kind' => 'photo', 'unlinked' => true]],
            'stateArgs' => ['recording' => ['Recording 10:18'], 'poll' => ['Poll 3, 9 of 12'], 'unlinked' => ['Whiteboard photo']],
        ],
        'consent-row' => [
            'helper' => 'ws_consent_row',
            'options' => [
                'id' => 'playground-consent',
                'title' => 'Send the recap to Slack',
                'what' => 'The recap and 6 actions, with owners',
                'where' => '#design-team in Slack',
                'when' => 'Once, when you press Send to Slack',
                'consent' => 'Post it to #design-team',
                'action' => 'Send to Slack',
                'alternative' => 'Copy it instead',
            ],
            'editable' => ['title', 'what', 'where', 'when', 'consent'],
            'script' => 'js/ws-agent.js',
            'states' => [
                'default' => [],
                'scheduled' => ['title' => 'Let Workshopr run the check-ins', 'what' => 'One email to each owner, asking how their commitment is going', 'where' => 'The 6 owners, from your address', 'when' => '7 and 30 days after the workshop', 'consent' => 'Send the check-ins for me', 'action' => 'Start check-ins', 'alternative' => 'I will follow up myself'],
            ],
        ],
        'menu' => [
            'helper' => 'ws_menu',
            'args' => ['Actions for Quarterly planning offsite', [
                ['label' => 'Open in Planner', 'href' => '/app/?view=plan&step=build&plan=42', 'icon' => 'edit_note', 'current' => true],
                ['label' => 'Run in Facilitator', 'href' => '/app/?view=facilitate&step=run&plan=42', 'icon' => 'play_arrow'],
                ['type' => 'separator'],
                ['label' => 'Duplicate', 'action' => 'duplicate', 'icon' => 'content_copy'],
                ['label' => 'Copy share link', 'action' => 'share', 'icon' => 'link'],
                ['label' => 'Save as template', 'action' => 'template', 'icon' => 'bookmark_add', 'disabled' => true, 'description' => 'Add an agenda first'],
                ['type' => 'separator'],
                ['label' => 'Delete', 'action' => 'delete', 'icon' => 'delete', 'danger' => true, 'modal' => 'pg-menu-delete'],
            ]],
            'text' => 0,
            'options' => ['id' => 'playground-menu', 'trigger' => 'icon', 'variant' => 'ghost', 'size' => 'sm', 'align' => 'end', 'placement' => 'bottom', 'mode' => 'menu'],
            'choices' => ['trigger' => ['icon', 'button'], 'variant' => ['ghost', 'secondary', 'primary'], 'size' => ['sm', 'md'], 'align' => ['end', 'start'], 'placement' => ['bottom', 'top'], 'mode' => ['menu', 'disclosure']],
            'states' => [
                'default' => [],
                'button' => ['trigger' => 'button', 'variant' => 'secondary', 'align' => 'start'],
                'sections' => ['trigger' => 'button', 'align' => 'start'],
                'disclosure' => ['trigger' => 'button', 'variant' => 'primary', 'align' => 'start', 'mode' => 'disclosure'],
                'long' => ['trigger' => 'button', 'variant' => 'secondary', 'align' => 'start'],
            ],
            'stateArgs' => [
                'button' => ['Export', [
                    ['label' => 'PDF', 'href' => '/app/?view=plan&step=build&plan=42&export=pdf', 'icon' => 'picture_as_pdf'],
                    ['label' => 'Slide deck', 'href' => '/app/?view=plan&step=build&plan=42&export=pptx', 'icon' => 'slideshow'],
                    ['label' => 'Run-of-show', 'href' => '/app/?view=plan&step=build&plan=42&export=run-of-show', 'icon' => 'format_list_numbered'],
                ]],
                'sections' => ['Switch workspace', [
                    ['type' => 'heading', 'label' => 'Personal'],
                    ['label' => 'Bill Bulman', 'description' => 'Personal space', 'icon' => 'person', 'action' => 'workspace-personal', 'current' => true],
                    ['type' => 'heading', 'label' => 'Workspaces'],
                    ['label' => 'Acme facilitation', 'description' => 'Owner', 'icon' => 'groups', 'action' => 'workspace-acme'],
                    ['label' => 'Northwind training', 'description' => 'Editor', 'icon' => 'groups', 'action' => 'workspace-northwind'],
                    ['type' => 'separator'],
                    ['label' => 'Create workspace', 'icon' => 'add', 'modal' => 'pg-menu-create'],
                ]],
                'disclosure' => ['Get the book', [
                    ['label' => 'Buy on Kindle', 'href' => '/academy/learn/1/index.php#getbook', 'icon' => 'shopping_bag'],
                    ['label' => 'Read online', 'href' => '/academy/learn/1/book1.php#about', 'icon' => 'auto_stories'],
                ]],
                'long' => ['Add a step', [
                    ['label' => 'Brainstorm', 'action' => 'brainstorm'],
                    ['label' => 'Check-in', 'action' => 'check-in'],
                    ['label' => 'Coffee break', 'action' => 'coffee-break'],
                    ['label' => 'Debrief', 'action' => 'debrief'],
                    ['label' => 'Dot voting', 'action' => 'dot-voting'],
                    ['label' => 'Energiser', 'action' => 'energiser'],
                    ['label' => 'Poll', 'action' => 'poll'],
                    ['label' => 'Quiz', 'action' => 'quiz'],
                    ['label' => 'Reflection', 'action' => 'reflection'],
                    ['label' => 'Silent timer', 'action' => 'silent-timer'],
                    ['label' => 'Sketch', 'action' => 'sketch'],
                    ['label' => 'Story round', 'action' => 'story-round'],
                ]],
            ],
            // The dialogs two items open: a destructive item always confirms in one (the destructive-confirmation recipe).
            'after' => [
                dsPlaygroundCall('ws_modal_start', [['id' => 'pg-menu-delete', 'title' => 'Delete this workshop?', 'size' => 'sm']]),
                '<p>Delete <strong>Quarterly planning offsite</strong> and its 14 agenda items? This cannot be undone.</p>',
                dsPlaygroundCall('ws_modal_footer', [['cancel' => ['text' => 'Keep workshop', 'attrs' => ['data-modal-close' => 'pg-menu-delete']], 'primary' => ['text' => 'Delete workshop', 'variant' => 'danger', 'icon' => 'delete']]]),
                dsPlaygroundCall('ws_modal_end', []),
                dsPlaygroundCall('ws_modal_start', [['id' => 'pg-menu-create', 'title' => 'Create a workspace', 'size' => 'sm']]),
                dsPlaygroundCall('ws_input', ['workspace-name', ['label' => 'Workspace name', 'required' => true]]),
                dsPlaygroundCall('ws_modal_footer', [['cancel' => ['text' => 'Cancel', 'attrs' => ['data-modal-close' => 'pg-menu-create']], 'primary' => ['text' => 'Create workspace', 'icon' => 'add']]]),
                dsPlaygroundCall('ws_modal_end', []),
            ],
        ],
        // One panel for a whole list: the template once, then each row's ws_menu naming it.
        'menu-panel' => [
            'helper' => 'ws_menu_panel',
            'args' => [[
                ['label' => 'Open in Planner', 'href' => '/app/?view=plan&step=build', 'icon' => 'edit_note'],
                ['label' => 'Duplicate', 'action' => 'duplicate', 'icon' => 'content_copy'],
                ['label' => 'Copy share link', 'action' => 'share', 'icon' => 'link'],
            ]],
            'options' => ['id' => 'pg-list-menu', 'mode' => 'menu'],
            'states' => ['default' => []],
            'after' => [
                dsPlaygroundCall('ws_menu', ['Actions for Quarterly planning offsite', [], ['id' => 'pg-row-42-menu', 'panel' => 'pg-list-menu']]),
                dsPlaygroundCall('ws_menu', ['Actions for Team retrospective', [], ['id' => 'pg-row-43-menu', 'panel' => 'pg-list-menu']]),
            ],
        ],
    ];
}

/** A nested helper call as a fixture value: rendered by calling it, printed as PHP. */
function dsPlaygroundCall(string $helper, array $args): array
{
    return ['__call' => $helper, 'args' => $args];
}

/** A helper's preview key: ws_empty_state is empty-state. */
function dsPlaygroundSlug(string $helper): string
{
    return str_replace('_', '-', preg_replace('/^ws_/', '', $helper));
}

/**
 * Why a catalog helper cannot preview here, or null when it can. $entry needs
 * the catalog's signature, scope and source. The playground is reachable on
 * production, so a helper whose source file can reach the database never
 * renders (dsPlaygroundDatabaseRisk), and one with no source is refused.
 */
function dsPlaygroundSkipReason(string $name, array $entry): ?string
{
    $known = [
        'ws_platform_version' => 'Returns the version string the app footer prints, and exists only once app-footer.php has rendered.',
        'ws_tooltip' => 'Returns attributes for another element, not markup of its own.',
    ];
    if (isset($known[$name])) return $known[$name];
    if (($entry['scope'] ?? '') === 'app-local') {
        return 'App-local to app/includes/workshop-list.php, whose listing loads the Workshop Record, team and migration code (config and the database).';
    }
    if (preg_match('/\):\s*\??(?:array|bool|int|float)\b/', (string) ($entry['signature'] ?? ''))) return 'Returns data, not markup.';
    $source = (string) ($entry['source'] ?? '');
    if (!preg_match('#^/[A-Za-z0-9/_-]+\.php$#', $source)) return 'Its source file is unknown, so the playground cannot show it never reaches the database.';
    return dsPlaygroundDatabaseRisk($name, dirname(__DIR__, 2) . $source);
}

/* The site bootstrap: loading any of these reads .env or opens the database. */
const DS_PLAYGROUND_BOOTSTRAP = ['config.php', 'db.php', 'shared-auth.php', 'env-loader.php'];

/* Functions and classes that open a database connection, lowercase and unqualified. */
const DS_PLAYGROUND_DB_FUNCTIONS = ['getdbconnection', 'mysqli_connect', 'mysqli_real_connect'];
const DS_PLAYGROUND_DB_CLASSES = ['pdo', 'mysqli'];

/* Functions that only ask whether a name exists: the string they are given is not called. */
const DS_PLAYGROUND_EXISTS_CHECKS = ['function_exists', 'is_callable', 'defined', 'class_exists', 'method_exists', 'interface_exists'];

/* Functions that call their first argument: given a variable there, what runs cannot be read. */
const DS_PLAYGROUND_CALLERS = ['call_user_func', 'call_user_func_array', 'forward_static_call', 'forward_static_call_array', 'array_map'];

/**
 * Why rendering $helper, defined in $file, could reach the database, or null when
 * it cannot. The code a render can run is read statically from the source: the
 * helper's body, the top-level code of every file loaded on the way (the
 * playground's own icon.php and helpers.php, the source, each include), and the
 * body of every definition of every function any of that calls (a name defined
 * twice behind function_exists guards is read both times). A string that names
 * a function (a callable such as 'getDbConnection' or 'Ns\fn') counts as a call
 * to it, and a qualified name counts by its last part. It is a risk when any of
 * it loads the site bootstrap; calls getDbConnection(), mysqli_connect() or
 * mysqli_real_connect(); constructs, extends or calls statically into PDO or
 * mysqli; constructs a class named at run time; hands call_user_func() or
 * array_map() a variable callable; or includes a path that is not a literal off
 * __DIR__, dirname(__DIR__), WS_ROOT or ws_path(). A function no loaded file
 * defines cannot run, so a guarded call to one is not a risk.
 */
function dsPlaygroundDatabaseRisk(string $helper, string $file): ?string
{
    static $cache = [];
    $root = dirname(__DIR__, 2);
    $shown = fn(string $p) => str_starts_with($p, $root . '/') ? substr($p, strlen($root) + 1) : $p;
    $start = realpath($file);
    if ($start === false) return 'Its source file ' . $shown($file) . ' does not exist.';
    $key = strtolower($helper) . '@' . $start;
    if (array_key_exists($key, $cache)) return $cache[$key];

    $functions = [];  // lowercase name => [[file, tokens], ...], one per definition
    $loaded = [];
    $queue = [];      // [where, file, tokens]
    $queued = [];     // lowercase name => how many of its definitions are queued
    $unreadable = null;
    $load = function (string $path) use (&$functions, &$loaded, &$queue, &$unreadable, $shown): void {
        if (isset($loaded[$path])) return;
        $loaded[$path] = true;
        $parsed = dsPlaygroundParsePhp($path);
        if ($parsed === null) { $unreadable ??= $shown($path); return; }
        foreach ($parsed['functions'] as $name => $bodies) {
            foreach ($bodies as $body) $functions[$name][] = [$path, $body];
        }
        $queue[] = [$shown($path), $path, $parsed['top']];
    };
    foreach ([$root . '/includes/icon.php', $root . '/includes/components/helpers.php', $start] as $f) $load(realpath($f) ?: $f);
    if ($unreadable !== null) return $cache[$key] = 'Could not read ' . $unreadable . ' to show rendering never reaches the database.';
    if (!isset($functions[strtolower($helper)])) return $cache[$key] = $shown($start) . ' does not define ' . $helper . '(), so the playground cannot read what it runs.';
    $called = [strtolower($helper) => true];
    $skipBefore = [T_FUNCTION, T_NEW, T_OBJECT_OPERATOR, T_NULLSAFE_OBJECT_OPERATOR, T_DOUBLE_COLON];
    $names = [T_STRING, T_NAME_FULLY_QUALIFIED, T_NAME_QUALIFIED, T_NAME_RELATIVE];
    // Ns\Fn and \Fn by their last part, lowercase.
    $bare = fn(string $name): string => strtolower((string) substr(strrchr('\\' . $name, '\\'), 1));
    while (true) {
        // A definition found in a file loaded later still runs if it wins, so it is read too.
        foreach (array_keys($called) as $name) {
            foreach (array_slice($functions[$name] ?? [], $queued[$name] ?? 0) as [$defFile, $defBody]) {
                $queue[] = [$shown($defFile) . ' (' . $name . ')', $defFile, $defBody];
            }
            $queued[$name] = count($functions[$name] ?? []);
        }
        if (!$queue) break;
        [$where, $unitFile, $toks] = array_shift($queue);
        $n = count($toks);
        for ($i = 0; $i < $n; $i++) {
            $t = $toks[$i];
            $id = is_array($t) ? $t[0] : null;
            if (in_array($id, [T_INCLUDE, T_INCLUDE_ONCE, T_REQUIRE, T_REQUIRE_ONCE], true)) {
                $expr = '';
                for ($depth = 0, $i++; $i < $n; $i++) {
                    $e = $toks[$i];
                    if ($e === '(' || $e === '[') $depth++;
                    elseif ($e === ')' || $e === ']') $depth--;
                    if ($depth < 0 || ($depth === 0 && ($e === ';' || $e === ',' || (is_array($e) && $e[0] === T_CLOSE_TAG)))) break;
                    $expr .= is_array($e) ? $e[1] : $e;
                }
                $expr = trim($expr);
                while (preg_match('/^\((.*)\)$/s', $expr, $pm)) $expr = trim($pm[1]);
                $target = dsPlaygroundIncludeTarget($expr, dirname($unitFile), $root);
                if ($target === null) return $cache[$key] = 'Includes ' . $expr . ' in ' . $where . ', a path the playground cannot follow to show it never reaches the database.';
                if (in_array(basename($target), DS_PLAYGROUND_BOOTSTRAP, true)) return $cache[$key] = 'Loads ' . $shown(realpath($target) ?: $target) . ' from ' . $where . ', which reads .env or opens the database.';
                $real = realpath($target);
                if ($real !== false) $load($real);
                if ($unreadable !== null) return $cache[$key] = 'Could not read ' . $unreadable . ' to show rendering never reaches the database.';
                continue;
            }
            if ($id === T_NEW) {
                $next = $toks[$i + 1] ?? null;
                if ($next === '(' || (is_array($next) && $next[0] === T_VARIABLE)) {
                    return $cache[$key] = 'Constructs a class named at run time in ' . $where . ', which the playground cannot follow to show it never reaches the database.';
                }
                continue;
            }
            if ($id === T_CONSTANT_ENCAPSED_STRING) {
                // A string naming a function may be called through it ('getDbConnection', 'Ns\fn',
                // 'PDO::connect'), unless it is only asked about, as in function_exists('x').
                $asked = ($toks[$i - 1] ?? null) === '(' && is_array($toks[$i - 2] ?? null)
                    && in_array($bare($toks[$i - 2][1]), DS_PLAYGROUND_EXISTS_CHECKS, true);
                if ($asked) continue;
                $literal = substr($t[1], 1, -1);
                if (preg_match('/^\\\\?[A-Za-z_][A-Za-z0-9_]*(?:\\\\{1,2}[A-Za-z_][A-Za-z0-9_]*)*$/', $literal)) {
                    $name = $bare(str_replace('\\\\', '\\', $literal));
                    if (in_array($name, DS_PLAYGROUND_DB_FUNCTIONS, true)) return $cache[$key] = "Names '" . $literal . "' in " . $where . ', a callable that opens a database connection.';
                    $called[$name] = true;
                } elseif (preg_match('/^\\\\?([A-Za-z0-9_\\\\]+)::/', $literal, $cm) && in_array($bare(str_replace('\\\\', '\\', $cm[1])), DS_PLAYGROUND_DB_CLASSES, true)) {
                    return $cache[$key] = "Names '" . $literal . "' in " . $where . ', a callable into a database class.';
                }
                continue;
            }
            if (!in_array($id, $names, true)) continue;
            $name = $bare($t[1]);
            $prev = $toks[$i - 1] ?? null;
            $next = $toks[$i + 1] ?? null;
            if (is_array($prev) && in_array($prev[0], [T_NEW, T_EXTENDS], true) && in_array($name, DS_PLAYGROUND_DB_CLASSES, true)) {
                return $cache[$key] = ($prev[0] === T_NEW ? 'Constructs ' : 'Extends ') . $t[1] . ' in ' . $where . '.';
            }
            if (is_array($prev) && in_array($prev[0], $skipBefore, true)) continue;
            if (is_array($next) && $next[0] === T_DOUBLE_COLON && in_array($name, DS_PLAYGROUND_DB_CLASSES, true)) {
                return $cache[$key] = 'Calls into ' . $t[1] . ' statically in ' . $where . '.';
            }
            if ($next !== '(') continue;
            if (in_array($name, DS_PLAYGROUND_DB_FUNCTIONS, true)) return $cache[$key] = 'Calls ' . $t[1] . '() in ' . $where . ', which rendering it can reach.';
            if (in_array($name, DS_PLAYGROUND_CALLERS, true) && is_array($toks[$i + 2] ?? null) && $toks[$i + 2][0] === T_VARIABLE) {
                return $cache[$key] = 'Hands ' . $t[1] . '() a callable held in a variable in ' . $where . ', which the playground cannot follow to show it never reaches the database.';
            }
            $called[$name] = true;
        }
    }
    return $cache[$key] = null;
}

/**
 * A PHP file as ['top' => tokens, 'functions' => [lowercase name => [tokens, ...]]]:
 * the code that runs when it loads (class bodies and closures stay in it) and the
 * body of each definition of each named function, in file order. Comments,
 * whitespace and inline HTML are dropped.
 */
function dsPlaygroundParsePhp(string $path): ?array
{
    static $cache = [];
    if (array_key_exists($path, $cache)) return $cache[$path];
    $src = @file_get_contents($path);
    if ($src === false) return $cache[$path] = null;
    $toks = array_values(array_filter(token_get_all($src), fn($t) => !is_array($t) || !in_array($t[0], [T_COMMENT, T_DOC_COMMENT, T_INLINE_HTML, T_WHITESPACE, T_OPEN_TAG], true)));
    $open = fn($t) => $t === '{' || (is_array($t) && in_array($t[0], [T_CURLY_OPEN, T_DOLLAR_OPEN_CURLY_BRACES], true));
    $top = [];
    $functions = [];
    $depth = 0;
    $classDepths = [];
    $classPending = false;
    $n = count($toks);
    for ($i = 0; $i < $n; $i++) {
        $t = $toks[$i];
        $id = is_array($t) ? $t[0] : null;
        $prev = $toks[$i - 1] ?? null;
        if (in_array($id, [T_CLASS, T_INTERFACE, T_TRAIT, T_ENUM], true) && !(is_array($prev) && $prev[0] === T_DOUBLE_COLON)) $classPending = true;
        $inClass = $classDepths && end($classDepths) === $depth - 1;
        $j = $i + 1;
        if (($toks[$j] ?? null) === '&' || (is_array($toks[$j] ?? null) && $toks[$j][1] === '&')) $j++;
        if ($id === T_FUNCTION && !$inClass && is_array($toks[$j] ?? null) && $toks[$j][0] === T_STRING) {
            // A named function: its body runs only when called, so it is kept apart from the top-level code.
            $name = strtolower($toks[$j][1]);
            for ($k = $j; $k < $n && !$open($toks[$k]) && $toks[$k] !== ';'; $k++);
            if ($k >= $n || $toks[$k] === ';') { $i = $k; continue; }
            $body = [];
            for ($d = 0; $k < $n; $k++) {
                if ($open($toks[$k])) $d++;
                elseif ($toks[$k] === '}') $d--;
                $body[] = $toks[$k];
                if ($d === 0) break;
            }
            $functions[$name][] = $body;
            $i = $k;
            continue;
        }
        if ($open($t)) {
            $depth++;
            if ($classPending) { $classDepths[] = $depth - 1; $classPending = false; }
        } elseif ($t === '}') {
            $depth--;
            if ($classDepths && end($classDepths) === $depth) array_pop($classDepths);
        }
        $top[] = $t;
    }
    return $cache[$path] = ['top' => $top, 'functions' => $functions];
}

/** The file an include expression names, when it is a literal path off __DIR__, dirname(__DIR__[, n]), WS_ROOT or ws_path(); else null. */
function dsPlaygroundIncludeTarget(string $expr, string $dir, string $root): ?string
{
    $lit = "'([^'\\\\]+)'";
    if (preg_match('/^__DIR__\s*\.\s*' . $lit . '$/', $expr, $m)) return $dir . '/' . ltrim($m[1], '/');
    if (preg_match('/^dirname\(\s*__DIR__\s*(?:,\s*(\d)\s*)?\)\s*\.\s*' . $lit . '$/', $expr, $m)) return dirname($dir, max(1, (int) ($m[1] ?: 1))) . '/' . ltrim($m[2], '/');
    if (preg_match('/^WS_ROOT\s*\.\s*' . $lit . '$/', $expr, $m)) return $root . '/' . ltrim($m[1], '/');
    if (preg_match('/^ws_path\(\s*' . $lit . '\s*\)$/', $expr, $m)) return $root . '/' . ltrim($m[1], '/');
    return null;
}

/** The catalog's components, from components.generated.json. */
function dsPlaygroundCatalog(): array
{
    static $components = null;
    if ($components === null) {
        $data = json_decode((string) @file_get_contents(dirname(__DIR__) . '/components.generated.json'), true);
        $components = is_array($data['components'] ?? null) ? $data['components'] : [];
    }
    return $components;
}

/** Helper name => the curated fixture key that previews it. */
function dsPlaygroundCurated(): array
{
    $out = [];
    foreach (dsPlaygroundFixtures() as $key => $fixture) {
        foreach (array_merge([$fixture['helper']], $fixture['covers'] ?? []) as $helper) $out[$helper] ??= $key;
    }
    return $out;
}

/**
 * Preview key => helper for every helper that gets an auto preview: listed in
 * the catalog (or $components, which the generator passes before it writes the
 * file), not previewed by a curated fixture and not skipped.
 */
function dsPlaygroundAutoHelpers(?array $components = null): array
{
    $curated = dsPlaygroundCurated();
    $fixtures = dsPlaygroundFixtures();
    $out = [];
    foreach ($components ?? dsPlaygroundCatalog() as $name => $entry) {
        $key = dsPlaygroundSlug($name);
        if (isset($curated[$name]) || isset($fixtures[$key]) || !preg_match('/^[a-z0-9-]+$/', $key)) continue;
        if (dsPlaygroundSkipReason($name, $entry) !== null) continue;
        $out[$key] = $name;
    }
    ksort($out);
    return $out;
}

/** The curated fixture or auto preview a key names, or null. */
function dsPlaygroundFixture(string $key): ?array
{
    $fixtures = dsPlaygroundFixtures();
    if (isset($fixtures[$key])) return $fixtures[$key];
    $name = dsPlaygroundAutoHelpers()[$key] ?? null;
    if ($name === null) return null;
    $entry = dsPlaygroundCatalog()[$name];
    // Page-level helpers live in their own file under includes/components/; helpers.php loads the rest.
    if (!function_exists($name) && preg_match('#^/includes/components/[a-z0-9-]+\.php$#', (string) ($entry['source'] ?? ''))) {
        require_once dirname(__DIR__, 2) . $entry['source'];
    }
    return function_exists($name) ? dsPlaygroundAutoFixture($name, $entry) : null;
}

/**
 * An auto preview: the call built from the catalog signature. Each argument is
 * the documented example's literal when it has one of the parameter's type (and
 * a value the catalog lists), else the catalog's positional default, the
 * signature default or a sample for its type. The options array keeps the
 * example's literal options the catalog allows, adds required ones, and sets
 * every option with listed values to its default so the controls can change it.
 */
function dsPlaygroundAutoFixture(string $name, array $entry): ?array
{
    if (!preg_match('/^ws_\w+\((.*)\)(?::\s*\S+)?$/', (string) ($entry['signature'] ?? ''), $sm)) return null;
    $slug = dsPlaygroundSlug($name);
    $example = dsPlaygroundExampleArgs($name, (string) ($entry['example'] ?? ''));
    $documented = [];
    foreach ((array) ($entry['params'] ?? []) as $p) $documented[ltrim((string) ($p['name'] ?? ''), '$')] = $p;
    $spec = (array) ($entry['optionSpec'] ?? []);
    $params = trim($sm[1]) === '' ? [] : preg_split('/,(?![^\[]*\])/', $sm[1]);
    $args = [];
    $options = null;
    $choices = [];
    foreach ($params as $i => $raw) {
        if (!preg_match('/^(?:(\??[\\\\\w|]+)\s+)?&?(?:\.\.\.)?\$(\w+)(?:\s*=\s*(.+))?$/', trim($raw), $pm)) return null;
        $type = $pm[1] ?? '';
        $param = $pm[2];
        if ($i === count($params) - 1 && in_array($param, ['options', 'opts'], true) && str_contains($type, 'array')) {
            [$options, $choices] = dsPlaygroundAutoOptions($spec, $example[$i] ?? null, $slug);
            break;
        }
        $values = is_array($documented[$param]['values'] ?? null) ? $documented[$param]['values'] : null;
        if (array_key_exists($i, $example) && dsPlaygroundFits($example[$i], $type) && ($values === null || dsPlaygroundListed($example[$i], $values))) {
            $args[] = $example[$i];
        } elseif ($values) {
            $args[] = $documented[$param]['default'] ?? $values[0];
        } elseif (isset($pm[3]) && dsPlaygroundLiteralOf($pm[3], $default)) {
            $args[] = $default;
        } else {
            $args[] = dsPlaygroundSample($type, $param, $slug);
        }
    }
    $states = ['default' => []];
    foreach ((array) ($entry['states'] ?? []) as $state) {
        if ($options === null || !is_string($state) || ($spec[$state]['type'] ?? '') !== 'bool') continue;
        $options[$state] ??= (bool) ($spec[$state]['default'] ?? false);
        $states[$state] = [$state => true];
    }
    return ['helper' => $name, 'args' => $args, 'options' => $options, 'choices' => $choices, 'states' => $states, 'auto' => true];
}

/** [options, choices] for an auto preview. */
function dsPlaygroundAutoOptions(array $spec, $literal, string $slug): array
{
    $options = [];
    foreach (is_array($literal) ? $literal : [] as $key => $value) {
        $values = $spec[$key]['values'] ?? null;
        // A value the catalog does not list is never taught, even when the demo uses it.
        if (is_array($values) && !dsPlaygroundListed($value, $values)) continue;
        $options[$key] = $value;
    }
    $choices = [];
    foreach ($spec as $key => $option) {
        if (!is_array($option)) continue;
        $required = !empty($option['required']) || preg_match('/^required\b/i', (string) ($option['description'] ?? ''));
        if ($required && !array_key_exists($key, $options)) {
            $options[$key] = $key === 'id' ? 'playground-' . $slug : dsPlaygroundSample((string) ($option['type'] ?? 'string'), (string) $key, $slug);
        }
        $values = array_values(array_filter((array) ($option['values'] ?? []), 'is_string'));
        if (count($values) < 2) continue;
        if (!array_key_exists($key, $options) && in_array($option['default'] ?? null, $values, true)) $options[$key] = $option['default'];
        if (is_string($options[$key] ?? null) && in_array($options[$key], $values, true)) $choices[$key] = $values;
    }
    return [$options, $choices];
}

/** Is $value one of the catalog's values? "2" and 2 are the same value. */
function dsPlaygroundListed($value, array $values): bool
{
    if (!is_scalar($value)) return false;
    foreach ($values as $listed) {
        if (is_scalar($listed) && (string) $listed === (string) $value) return true;
    }
    return false;
}

/** Does a literal value suit a declared parameter type ("?string", "int|float")? */
function dsPlaygroundFits($value, string $type): bool
{
    if ($type === '' || $type === 'mixed') return true;
    if ($value === null && str_starts_with($type, '?')) return true;
    foreach (explode('|', ltrim($type, '?')) as $t) {
        $fits = match (strtolower(ltrim($t, '\\'))) {
            'string' => is_string($value),
            'array' => is_array($value),
            'int' => is_int($value),
            'float' => is_float($value) || is_int($value),
            'bool' => is_bool($value),
            'null' => $value === null,
            default => false,
        };
        if ($fits) return true;
    }
    return false;
}

/** A sample argument for a parameter the example gives no literal for. */
function dsPlaygroundSample(string $type, string $param, string $slug)
{
    $types = array_map(fn($t) => strtolower(ltrim($t, '?\\')), explode('|', $type));
    if ($type === '' || in_array('string', $types, true)) {
        return match ($param) {
            'name' => 'playground_' . str_replace('-', '_', $slug),
            'title', 'heading' => 'Quarterly planning offsite',
            'body', 'content' => '<p>Two hours, eight people and one decision to make by the end.</p>',
            'icon' => 'event_note',
            'src', 'url' => '',
            'href' => '#',
            'phase' => 'plan',
            'duration' => '45 min',
            'category' => 'Strategy',
            'value' => '12',
            'label' => 'Workshops run',
            default => 'Sample text',
        };
    }
    if (in_array('array', $types, true)) return [];
    if (in_array('int', $types, true) || in_array('float', $types, true)) return 60;
    if (in_array('bool', $types, true)) return true;
    return null;
}

/** Parse one PHP literal (a signature default) into $value. False when it is not a plain literal. */
function dsPlaygroundLiteralOf(string $raw, &$value): bool
{
    $toks = dsPlaygroundTokens('<?php ' . $raw . ';');
    $p = 0;
    $ok = true;
    $value = dsPlaygroundLiteral($toks, $p, $ok);
    return $ok && ($toks[$p][1] ?? null) === ';';
}

/** PHP tokens as [id, text] pairs, without whitespace, comments or open and close tags. */
function dsPlaygroundTokens(string $code): array
{
    $skip = [T_WHITESPACE, T_COMMENT, T_DOC_COMMENT, T_OPEN_TAG, T_OPEN_TAG_WITH_ECHO, T_CLOSE_TAG, T_INLINE_HTML];
    $out = [];
    foreach (@token_get_all($code) as $t) {
        if (is_array($t) && in_array($t[0], $skip, true)) continue;
        $out[] = is_array($t) ? [$t[0], $t[1]] : [0, $t];
    }
    return $out;
}

/**
 * The literal arguments of the first $name(...) call in a documented example,
 * keyed by position. The example is tokenized, never executed: an argument that
 * is anything but strings, numbers, booleans, null and arrays of them is absent.
 */
function dsPlaygroundExampleArgs(string $name, string $example): array
{
    if (!str_contains($example, $name . '(')) return [];
    $toks = dsPlaygroundTokens(str_starts_with(ltrim($example), '<?') ? $example : '<?php ' . $example);
    $n = count($toks);
    for ($p = 0; $p < $n - 1; $p++) {
        if ($toks[$p][0] === T_STRING && $toks[$p][1] === $name && $toks[$p + 1][1] === '(') break;
    }
    if ($p >= $n - 1) return [];
    $p += 2;
    $args = [];
    for ($i = 0; $p < $n && $toks[$p][1] !== ')'; $i++) {
        $start = $p;
        $ok = true;
        $value = dsPlaygroundLiteral($toks, $p, $ok);
        if ($ok && in_array($toks[$p][1] ?? null, [',', ')'], true)) {
            $args[$i] = $value;
        } else {
            $p = dsPlaygroundSkipArgument($toks, $start);
        }
        if (($toks[$p][1] ?? null) !== ',') break;
        $p++;
    }
    return $args;
}

/** The index of the comma or closing parenthesis that ends the argument starting at $p. */
function dsPlaygroundSkipArgument(array $toks, int $p): int
{
    for ($depth = 0, $n = count($toks); $p < $n; $p++) {
        $c = $toks[$p][1];
        if ($c === '(' || $c === '[' || $c === '{' || $toks[$p][0] === T_CURLY_OPEN || $toks[$p][0] === T_DOLLAR_OPEN_CURLY_BRACES) {
            $depth++;
        } elseif ($c === ')' || $c === ']' || $c === '}') {
            if ($depth === 0) return $p;
            $depth--;
        } elseif ($c === ',' && $depth === 0) {
            return $p;
        }
    }
    return $p;
}

/** One literal value at $p, advancing $p past it. Sets $ok to false on anything else. */
function dsPlaygroundLiteral(array $toks, int &$p, bool &$ok)
{
    [$id, $text] = $toks[$p] ?? [0, ''];
    if ($id === T_CONSTANT_ENCAPSED_STRING) {
        $p++;
        if ($text[0] === "'") return preg_replace("/\\\\(['\\\\])/", '$1', substr($text, 1, -1));
        if (!str_contains($text, '$')) return stripcslashes(substr($text, 1, -1));
    } elseif (($id === T_LNUMBER || $id === T_DNUMBER) && is_numeric($text)) {
        $p++;
        return $text + 0;
    } elseif ($text === '-' && in_array($toks[$p + 1][0] ?? 0, [T_LNUMBER, T_DNUMBER], true) && is_numeric($toks[$p + 1][1])) {
        $p += 2;
        return -($toks[$p - 1][1] + 0);
    } elseif ($id === T_STRING && in_array(strtolower($text), ['true', 'false', 'null'], true) && ($toks[$p + 1][1] ?? '') !== '(') {
        $p++;
        return ['true' => true, 'false' => false, 'null' => null][strtolower($text)];
    } elseif ($text === '[' || ($id === T_ARRAY && ($toks[$p + 1][1] ?? '') === '(')) {
        $close = $text === '[' ? ']' : ')';
        $p += $text === '[' ? 1 : 2;
        $out = [];
        while ($ok && isset($toks[$p]) && $toks[$p][1] !== $close) {
            $item = dsPlaygroundLiteral($toks, $p, $ok);
            if ($ok && ($toks[$p][0] ?? 0) === T_DOUBLE_ARROW) {
                $p++;
                $ok = is_int($item) || is_string($item);
                if ($ok) $out[$item] = dsPlaygroundLiteral($toks, $p, $ok);
            } elseif ($ok) {
                $out[] = $item;
            }
            if (!$ok) break;
            if (($toks[$p][1] ?? null) === ',') $p++;
            elseif (($toks[$p][1] ?? null) !== $close) $ok = false;
        }
        if ($ok && isset($toks[$p])) {
            $p++;
            return $out;
        }
    }
    $ok = false;
    return null;
}

/** Every previewable key => its label in the component picker; auto previews say so. */
function dsPlaygroundKeys(): array
{
    $out = [];
    foreach (array_keys(dsPlaygroundFixtures()) as $key) $out[$key] = ucwords(str_replace('-', ' ', $key));
    foreach (array_keys(dsPlaygroundAutoHelpers()) as $key) $out[$key] = ucwords(str_replace('-', ' ', $key)) . ' (auto)';
    return $out;
}

function dsPlaygroundSelection(array $query): array
{
    $key = is_string($query['component'] ?? null) ? $query['component'] : 'button';
    $fixture = preg_match('/^[a-z0-9-]+$/', $key) ? dsPlaygroundFixture($key) : null;
    if ($fixture === null) {
        $key = 'button';
        $fixture = dsPlaygroundFixtures()['button'];
    }
    $state = is_string($query['state'] ?? null) ? $query['state'] : 'default';
    if (!isset($fixture['states'][$state])) $state = 'default';
    $args = $fixture['args'] ?? [];
    foreach ($fixture['stateArgs'][$state] ?? [] as $i => $value) $args[$i] = $value;
    $options = null;
    if (($fixture['options'] ?? null) !== null) {
        $options = $fixture['options'];
        foreach ($fixture['states'][$state] as $name => $value) {
            if ($value === null) unset($options[$name]);
            else $options[$name] = $value;
        }
        foreach ($options as $name => $value) {
            if ($name === 'id' || !isset($query[$name]) || !is_string($query[$name])) continue;
            if (is_bool($value)) $options[$name] = $query[$name] === '1';
            elseif (isset($fixture['choices'][$name])) {
                if (in_array($query[$name], $fixture['choices'][$name], true)) $options[$name] = $query[$name];
            } elseif (is_string($value) && in_array($name, $fixture['editable'] ?? [], true)) {
                $options[$name] = substr($query[$name], 0, 500);
            }
        }
    }
    // HTML slots are fixtures, never executable or raw user-provided markup.
    $slot = $fixture['text'] ?? null;
    if ($slot !== null && is_string($query['text'] ?? null)) {
        $text = substr($query['text'], 0, 1000);
        $escaped = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        $args[$slot] = match ($fixture['html'] ?? null) {
            'p' => '<p>' . $escaped . '</p>',
            'inline' => $escaped,
            default => $text,
        };
    }
    return ['key' => $key, 'fixture' => $fixture, 'state' => $state, 'args' => $args, 'options' => $options, 'auto' => !empty($fixture['auto'])];
}

/** A fixture value with every dsPlaygroundCall() replaced by its output. */
function dsPlaygroundValue($value)
{
    if (is_array($value) && isset($value['__call'])) {
        $helper = $value['__call'];
        if (!preg_match('/^ws_[a-z0-9_]+$/', $helper) || !function_exists($helper)) return '';
        ob_start();
        $result = $helper(...array_map('dsPlaygroundValue', $value['args']));
        return (string) ob_get_clean() . (is_string($result) ? $result : '');
    }
    return is_array($value) ? array_map('dsPlaygroundValue', $value) : $value;
}

/** The selection's helper call, with its options array last when it takes one. */
function dsPlaygroundMainCall(array $selection): array
{
    $args = $selection['args'];
    if ($selection['options'] !== null) $args[] = $selection['options'];
    return dsPlaygroundCall($selection['fixture']['helper'], $args);
}

/** The calls and HTML a selection renders, in order. */
function dsPlaygroundParts(array $selection): array
{
    $fixture = $selection['fixture'];
    $parts = [];
    foreach ($fixture['before'] ?? [] as $part) $parts[] = $part;
    if (!empty($fixture['trigger'])) {
        $parts[] = dsPlaygroundCall('ws_button', [$fixture['trigger'][0], ['attrs' => ['data-modal-open' => $fixture['trigger'][1]]]]);
    }
    $call = dsPlaygroundMainCall($selection);
    $frame = $fixture['frame'] ?? null;
    if ($frame === 'pair') {
        $parts = array_merge($parts, [$call], $fixture['body'] ?? [], [dsPlaygroundCall($fixture['close'], [])]);
    } elseif ($frame === 'modal') {
        $parts = array_merge($parts, [dsPlaygroundCall('ws_modal_start', [$fixture['modal']])], $fixture['body'] ?? [], [$call, dsPlaygroundCall('ws_modal_end', [])]);
    } else {
        $parts[] = $call;
    }
    foreach ($fixture['after'] ?? [] as $part) $parts[] = $part;
    return $parts;
}

/** The script under js/ a fixture's behaviour needs, or null. Only a plain js/<name>.js file resolves. */
function dsPlaygroundScript(array $fixture): ?string
{
    $script = $fixture['script'] ?? null;
    return is_string($script) && preg_match('#^js/[a-z0-9-]+\.js$#', $script) && is_file(dirname(__DIR__, 2) . '/' . $script) ? $script : null;
}

function dsPlaygroundRender(array $selection): string
{
    // One buffer for the whole sequence, as a page would run it: a pair whose start
    // buffers its own content (ws_form_row_start) breaks if each call is captured
    // and closed on its own.
    ob_start();
    foreach (dsPlaygroundParts($selection) as $part) {
        if (!is_array($part) || !isset($part['__call'])) {
            echo is_string($part) ? $part : '';
            continue;
        }
        $helper = $part['__call'];
        if (!preg_match('/^ws_[a-z0-9_]+$/', $helper) || !function_exists($helper)) continue;
        $result = $helper(...array_map('dsPlaygroundValue', $part['args']));
        if (is_string($result)) echo $result;
    }
    return (string) ob_get_clean();
}

/** The wsToast() calls a selection makes on load, as [message, variant, action label]. */
function dsPlaygroundToasts(array $selection): array
{
    return $selection['fixture']['toasts'][$selection['state']] ?? [];
}

function dsPlaygroundCode(array $selection): string
{
    $lines = [];
    foreach (dsPlaygroundParts($selection) as $part) {
        if (is_string($part)) {
            $lines[] = $part;
            continue;
        }
        $helper = $part['__call'];
        $php = dsPlaygroundExport($part);
        $void = function_exists($helper) && (string) (new ReflectionFunction($helper))->getReturnType() === 'void';
        $lines[] = $void ? "<?php $php; ?>" : "<?= $php ?>";
    }
    if ($script = dsPlaygroundScript($selection['fixture'])) {
        $lines[] = '<script src="/' . $script . '?v=<?= filemtime(WS_ROOT . \'/' . $script . '\') ?>"></script>';
    }
    if ($toasts = dsPlaygroundToasts($selection)) {
        $lines[] = '<script>';
        foreach ($toasts as [$message, $variant, $action]) {
            $call = 'wsToast(' . json_encode($message) . ', ' . json_encode($variant);
            if ($action !== null) $call .= ', { action: { label: ' . json_encode($action) . ', onClick: () => restoreActivity() } }';
            $lines[] = $call . ');';
        }
        $lines[] = '</script>';
    }
    return implode("\n", $lines);
}

/** A fixture value as PHP source: short arrays, nested helper calls as calls. */
function dsPlaygroundExport($value, int $depth = 0): string
{
    if (is_array($value) && isset($value['__call'])) {
        return $value['__call'] . '(' . implode(', ', array_map(fn($arg) => dsPlaygroundExport($arg, $depth), $value['args'])) . ')';
    }
    if (!is_array($value)) return $value === null ? 'null' : var_export($value, true);
    if ($value === []) return '[]';
    $list = array_is_list($value);
    $items = [];
    foreach ($value as $key => $item) $items[] = ($list ? '' : var_export($key, true) . ' => ') . dsPlaygroundExport($item, $depth + 1);
    $inline = '[' . implode(', ', $items) . ']';
    if (strlen($inline) <= 72 && !str_contains($inline, "\n")) return $inline;
    $pad = str_repeat('    ', $depth + 1);
    return "[\n" . $pad . implode(",\n" . $pad, $items) . ",\n" . str_repeat('    ', $depth) . ']';
}

/* ---------------------------------------------------------------------------
 * Screen recipes and preview addresses. A separate block from the component
 * fixtures above.
 *
 * design-system/recipes.json lists the recipes and design-system/recipes/<id>.php
 * renders each state from fixture data. playground.php serves every recipe
 * state and every component fixture as an isolated preview, composition.php
 * shows the recipes, and generate-catalog.php publishes the same URLs, so all
 * three agree on one address.
 * ------------------------------------------------------------------------- */

/** Recipes keyed by id, in recipes.json order. Only ids that can name a file resolve. */
function dsRecipes(): array
{
    $data = json_decode((string) @file_get_contents(dirname(__DIR__) . '/recipes.json'), true);
    $out = [];
    foreach ($data['recipes'] ?? [] as $recipe) {
        if (!is_array($recipe) || !preg_match('/^[a-z0-9-]+$/', (string) ($recipe['id'] ?? ''))) continue;
        $out[$recipe['id']] = $recipe;
    }
    return $out;
}

function dsRecipeFile(string $id): string
{
    return dirname(__DIR__) . '/recipes/' . $id . '.php';
}

function dsRecipePreviewUrl(string $id, string $state = 'default'): string
{
    return '/design-system/components/playground.php?' . http_build_query(['recipe' => $id, 'state' => $state, 'preview' => '1']);
}

/** The recipe and state a request names, or null. Only listed ids and states resolve. */
function dsRecipeSelection(array $query): ?array
{
    $recipes = dsRecipes();
    $id = is_string($query['recipe'] ?? null) ? $query['recipe'] : '';
    if (!isset($recipes[$id]) || !is_readable(dsRecipeFile($id))) return null;
    $state = is_string($query['state'] ?? null) ? $query['state'] : 'default';
    if (!in_array($state, $recipes[$id]['states'] ?? [], true)) $state = 'default';
    return ['recipe' => $recipes[$id], 'state' => $state];
}

/** One recipe state as HTML. The recipe file sees only $state. */
function dsRenderRecipe(string $id, string $state): string
{
    ob_start();
    (static function (string $__file, string $state): void { include $__file; })(dsRecipeFile($id), $state);
    return (string) ob_get_clean();
}

/** The isolated preview of a component fixture, the address the catalog publishes as `preview`. */
function dsPlaygroundPreviewUrl(string $key, string $state = 'default'): string
{
    return '/design-system/components/playground.php?' . http_build_query(['component' => $key, 'state' => $state, 'preview' => '1']);
}
