<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo $themePath;?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo $themePath;?>css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .jambi-wrapper .filter-section .filter-control .form-control{
            display: inline;
            width: auto;
        }
        .page-jambi{
            position: relative;
            padding-bottom: 20px;
        }
        .data-wrapper {
            overflow-x: scroll;
            width: 100%;
        }
        .responsive-two-cols tbody tr > td{
            padding: 4px 0;
        }
        .responsive-two-cols tbody tr > td:first-child{
            width: 200px;
        }

        .pagination{
            display: block !important;
            
        }
        .pagination-top{
            padding: 5px 0 10px 0;
        }

        .pagination-bottom{
            padding: 10px 0 5px 0;
        }

        .pagination-number{
            text-align: center;
        }

        

        .page-selector a {
            position: relative;
            display: inline-block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #4e73df;
            background-color: #fff;
            border: 1px solid #dddfeb;
            border-top-color: rgb(221, 223, 235);
            border-right-color: rgb(221, 223, 235);
            border-bottom-color: rgb(221, 223, 235);
            border-left-color: rgb(221, 223, 235);
        }
        .pagination-number > .page-selector:first-child a{
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }
        .pagination-number > .page-selector:last-child a{
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }
        .page-selector a:hover{
            text-decoration: none;
        }

        .page-selector.page-selected a{

            background-color: #4e73df;
            border-color: #4e73df;
            color: #fff;
        }

        .data-section{
            padding: 10px 0;
        }


        .form-check-input{
            position: static;
            margin-left: 0;
        }

        .dropdown-menu-right .dropdown-item{
            padding: .25rem 1rem;
        }
        .dropdown-menu-right .dropdown-header{
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .navbar {
            padding: .5rem .5rem;
        }
        .table-row td{
            white-space: nowrap;
        }
        .table-row td.data-controll{
            width: 20px;
        }
        .table-row td.data-controll.data-number{
            width: 24px;
        }
        .table-row tbody td.data-number{
            text-align: right;
        }

        .filter-section form
        {
            line-height: 44px;
        }

        .filter-group{
            white-space: nowrap;
        }


        thead .data-sort-header{
            width: 8px;
            background-color: #858796;
        }
        tbody .data-sort-body{
            width: 8px;
            background-color: #4e73df;
            cursor: move;
        }
        .table-row td{
            padding: 0.5rem 0.6rem;
        }

        .filter-form select{
            max-width: 200px;
        }
    </style>

<script
src="https://code.jquery.com/jquery-1.12.4.min.js"
integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
crossorigin="anonymous"></script>

    <script>

        /**!
         * Sortable
         * @author	RubaXa   <trash@rubaxa.org>
         * @license MIT
         */

        (function sortableModule(factory) {
            "use strict";

            if (typeof define === "function" && define.amd) {
                define(factory);
            }
            else if (typeof module != "undefined" && typeof module.exports != "undefined") {
                module.exports = factory();
            }
            else {
                /* jshint sub:true */
                window["Sortable"] = factory();
            }
        })(function sortableFactory() {
            "use strict";

            if (typeof window == "undefined" || !window.document) {
                return function sortableError() {
                    throw new Error("Sortable.js requires a window with a document");
                };
            }

            var dragEl,
                parentEl,
                ghostEl,
                cloneEl,
                rootEl,
                nextEl,
                lastDownEl,

                scrollEl,
                scrollParentEl,
                scrollCustomFn,

                lastEl,
                lastCSS,
                lastParentCSS,

                oldIndex,
                newIndex,

                activeGroup,
                putSortable,

                autoScroll = {},

                tapEvt,
                touchEvt,

                moved,

                /** @const */
                R_SPACE = /\s+/g,
                R_FLOAT = /left|right|inline/,

                expando = 'Sortable' + (new Date).getTime(),

                win = window,
                document = win.document,
                parseInt = win.parseInt,

                $ = win.jQuery || win.Zepto,
                Polymer = win.Polymer,

                captureMode = false,

                supportDraggable = !!('draggable' in document.createElement('div')),
                supportCssPointerEvents = (function (el) {
                    // false when IE11
                    if (!!navigator.userAgent.match(/Trident.*rv[ :]?11\./)) {
                        return false;
                    }
                    el = document.createElement('x');
                    el.style.cssText = 'pointer-events:auto';
                    return el.style.pointerEvents === 'auto';
                })(),

                _silent = false,

                abs = Math.abs,
                min = Math.min,

                savedInputChecked = [],
                touchDragOverListeners = [],

                _autoScroll = _throttle(function (/**Event*/evt, /**Object*/options, /**HTMLElement*/rootEl) {
                    // Bug: https://bugzilla.mozilla.org/show_bug.cgi?id=505521
                    if (rootEl && options.scroll) {
                        var _this = rootEl[expando],
                            el,
                            rect,
                            sens = options.scrollSensitivity,
                            speed = options.scrollSpeed,

                            x = evt.clientX,
                            y = evt.clientY,

                            winWidth = window.innerWidth,
                            winHeight = window.innerHeight,

                            vx,
                            vy,

                            scrollOffsetX,
                            scrollOffsetY
                        ;

                        // Delect scrollEl
                        if (scrollParentEl !== rootEl) {
                            scrollEl = options.scroll;
                            scrollParentEl = rootEl;
                            scrollCustomFn = options.scrollFn;

                            if (scrollEl === true) {
                                scrollEl = rootEl;

                                do {
                                    if ((scrollEl.offsetWidth < scrollEl.scrollWidth) ||
                                        (scrollEl.offsetHeight < scrollEl.scrollHeight)
                                    ) {
                                        break;
                                    }
                                    /* jshint boss:true */
                                } while (scrollEl = scrollEl.parentNode);
                            }
                        }

                        if (scrollEl) {
                            el = scrollEl;
                            rect = scrollEl.getBoundingClientRect();
                            vx = (abs(rect.right - x) <= sens) - (abs(rect.left - x) <= sens);
                            vy = (abs(rect.bottom - y) <= sens) - (abs(rect.top - y) <= sens);
                        }


                        if (!(vx || vy)) {
                            vx = (winWidth - x <= sens) - (x <= sens);
                            vy = (winHeight - y <= sens) - (y <= sens);

                            /* jshint expr:true */
                            (vx || vy) && (el = win);
                        }


                        if (autoScroll.vx !== vx || autoScroll.vy !== vy || autoScroll.el !== el) {
                            autoScroll.el = el;
                            autoScroll.vx = vx;
                            autoScroll.vy = vy;

                            clearInterval(autoScroll.pid);

                            if (el) {
                                autoScroll.pid = setInterval(function () {
                                    scrollOffsetY = vy ? vy * speed : 0;
                                    scrollOffsetX = vx ? vx * speed : 0;

                                    if ('function' === typeof(scrollCustomFn)) {
                                        return scrollCustomFn.call(_this, scrollOffsetX, scrollOffsetY, evt);
                                    }

                                    if (el === win) {
                                        win.scrollTo(win.pageXOffset + scrollOffsetX, win.pageYOffset + scrollOffsetY);
                                    } else {
                                        el.scrollTop += scrollOffsetY;
                                        el.scrollLeft += scrollOffsetX;
                                    }
                                }, 24);
                            }
                        }
                    }
                }, 30),

                _prepareGroup = function (options) {
                    function toFn(value, pull) {
                        if (value === void 0 || value === true) {
                            value = group.name;
                        }

                        if (typeof value === 'function') {
                            return value;
                        } else {
                            return function (to, from) {
                                var fromGroup = from.options.group.name;

                                return pull
                                    ? value
                                    : value && (value.join
                                        ? value.indexOf(fromGroup) > -1
                                        : (fromGroup == value)
                                    );
                            };
                        }
                    }

                    var group = {};
                    var originalGroup = options.group;

                    if (!originalGroup || typeof originalGroup != 'object') {
                        originalGroup = {name: originalGroup};
                    }

                    group.name = originalGroup.name;
                    group.checkPull = toFn(originalGroup.pull, true);
                    group.checkPut = toFn(originalGroup.put);
                    group.revertClone = originalGroup.revertClone;

                    options.group = group;
                }
            ;


            /**
             * @class  Sortable
             * @param  {HTMLElement}  el
             * @param  {Object}       [options]
             */
            function Sortable(el, options) {
                if (!(el && el.nodeType && el.nodeType === 1)) {
                    throw 'Sortable: `el` must be HTMLElement, and not ' + {}.toString.call(el);
                }

                this.el = el; // root element
                this.options = options = _extend({}, options);


                // Export instance
                el[expando] = this;

                // Default options
                var defaults = {
                    group: Math.random(),
                    sort: true,
                    disabled: false,
                    store: null,
                    handle: null,
                    scroll: true,
                    scrollSensitivity: 30,
                    scrollSpeed: 10,
                    draggable: /[uo]l/i.test(el.nodeName) ? 'li' : '>*',
                    ghostClass: 'sortable-ghost',
                    chosenClass: 'sortable-chosen',
                    dragClass: 'sortable-drag',
                    ignore: 'a, img',
                    filter: null,
                    preventOnFilter: true,
                    animation: 0,
                    setData: function (dataTransfer, dragEl) {
                        dataTransfer.setData('Text', dragEl.textContent);
                    },
                    dropBubble: false,
                    dragoverBubble: false,
                    dataIdAttr: 'data-id',
                    delay: 0,
                    forceFallback: false,
                    fallbackClass: 'sortable-fallback',
                    fallbackOnBody: false,
                    fallbackTolerance: 0,
                    fallbackOffset: {x: 0, y: 0}
                };


                // Set default options
                for (var name in defaults) {
                    !(name in options) && (options[name] = defaults[name]);
                }

                _prepareGroup(options);

                // Bind all private methods
                for (var fn in this) {
                    if (fn.charAt(0) === '_' && typeof this[fn] === 'function') {
                        this[fn] = this[fn].bind(this);
                    }
                }

                // Setup drag mode
                this.nativeDraggable = options.forceFallback ? false : supportDraggable;

                // Bind events
                _on(el, 'mousedown', this._onTapStart);
                _on(el, 'touchstart', this._onTapStart);
                _on(el, 'pointerdown', this._onTapStart);

                if (this.nativeDraggable) {
                    _on(el, 'dragover', this);
                    _on(el, 'dragenter', this);
                }

                touchDragOverListeners.push(this._onDragOver);

                // Restore sorting
                options.store && this.sort(options.store.get(this));
            }


            Sortable.prototype = /** @lends Sortable.prototype */ {
                constructor: Sortable,

                _onTapStart: function (/** Event|TouchEvent */evt) {
                    var _this = this,
                        el = this.el,
                        options = this.options,
                        preventOnFilter = options.preventOnFilter,
                        type = evt.type,
                        touch = evt.touches && evt.touches[0],
                        target = (touch || evt).target,
                        originalTarget = evt.target.shadowRoot && (evt.path && evt.path[0]) || target,
                        filter = options.filter,
                        startIndex;

                    _saveInputCheckedState(el);


                    // Don't trigger start event when an element is been dragged, otherwise the evt.oldindex always wrong when set option.group.
                    if (dragEl) {
                        return;
                    }

                    if (/mousedown|pointerdown/.test(type) && evt.button !== 0 || options.disabled) {
                        return; // only left button or enabled
                    }


                    target = _closest(target, options.draggable, el);

                    if (!target) {
                        return;
                    }

                    if (lastDownEl === target) {
                        // Ignoring duplicate `down`
                        return;
                    }

                    // Get the index of the dragged element within its parent
                    startIndex = _index(target, options.draggable);

                    // Check filter
                    if (typeof filter === 'function') {
                        if (filter.call(this, evt, target, this)) {
                            _dispatchEvent(_this, originalTarget, 'filter', target, el, startIndex);
                            preventOnFilter && evt.preventDefault();
                            return; // cancel dnd
                        }
                    }
                    else if (filter) {
                        filter = filter.split(',').some(function (criteria) {
                            criteria = _closest(originalTarget, criteria.trim(), el);

                            if (criteria) {
                                _dispatchEvent(_this, criteria, 'filter', target, el, startIndex);
                                return true;
                            }
                        });

                        if (filter) {
                            preventOnFilter && evt.preventDefault();
                            return; // cancel dnd
                        }
                    }

                    if (options.handle && !_closest(originalTarget, options.handle, el)) {
                        return;
                    }

                    // Prepare `dragstart`
                    this._prepareDragStart(evt, touch, target, startIndex);
                },

                _prepareDragStart: function (/** Event */evt, /** Touch */touch, /** HTMLElement */target, /** Number */startIndex) {
                    var _this = this,
                        el = _this.el,
                        options = _this.options,
                        ownerDocument = el.ownerDocument,
                        dragStartFn;

                    if (target && !dragEl && (target.parentNode === el)) {
                        tapEvt = evt;

                        rootEl = el;
                        dragEl = target;
                        parentEl = dragEl.parentNode;
                        nextEl = dragEl.nextSibling;
                        lastDownEl = target;
                        activeGroup = options.group;
                        oldIndex = startIndex;

                        this._lastX = (touch || evt).clientX;
                        this._lastY = (touch || evt).clientY;

                        dragEl.style['will-change'] = 'transform';

                        dragStartFn = function () {
                            // Delayed drag has been triggered
                            // we can re-enable the events: touchmove/mousemove
                            _this._disableDelayedDrag();

                            // Make the element draggable
                            dragEl.draggable = _this.nativeDraggable;

                            // Chosen item
                            _toggleClass(dragEl, options.chosenClass, true);

                            // Bind the events: dragstart/dragend
                            _this._triggerDragStart(evt, touch);

                            // Drag start event
                            _dispatchEvent(_this, rootEl, 'choose', dragEl, rootEl, oldIndex);
                        };

                        // Disable "draggable"
                        options.ignore.split(',').forEach(function (criteria) {
                            _find(dragEl, criteria.trim(), _disableDraggable);
                        });

                        _on(ownerDocument, 'mouseup', _this._onDrop);
                        _on(ownerDocument, 'touchend', _this._onDrop);
                        _on(ownerDocument, 'touchcancel', _this._onDrop);
                        _on(ownerDocument, 'pointercancel', _this._onDrop);
                        _on(ownerDocument, 'selectstart', _this);

                        if (options.delay) {
                            // If the user moves the pointer or let go the click or touch
                            // before the delay has been reached:
                            // disable the delayed drag
                            _on(ownerDocument, 'mouseup', _this._disableDelayedDrag);
                            _on(ownerDocument, 'touchend', _this._disableDelayedDrag);
                            _on(ownerDocument, 'touchcancel', _this._disableDelayedDrag);
                            _on(ownerDocument, 'mousemove', _this._disableDelayedDrag);
                            _on(ownerDocument, 'touchmove', _this._disableDelayedDrag);
                            _on(ownerDocument, 'pointermove', _this._disableDelayedDrag);

                            _this._dragStartTimer = setTimeout(dragStartFn, options.delay);
                        } else {
                            dragStartFn();
                        }


                    }
                },

                _disableDelayedDrag: function () {
                    var ownerDocument = this.el.ownerDocument;

                    clearTimeout(this._dragStartTimer);
                    _off(ownerDocument, 'mouseup', this._disableDelayedDrag);
                    _off(ownerDocument, 'touchend', this._disableDelayedDrag);
                    _off(ownerDocument, 'touchcancel', this._disableDelayedDrag);
                    _off(ownerDocument, 'mousemove', this._disableDelayedDrag);
                    _off(ownerDocument, 'touchmove', this._disableDelayedDrag);
                    _off(ownerDocument, 'pointermove', this._disableDelayedDrag);
                },

                _triggerDragStart: function (/** Event */evt, /** Touch */touch) {
                    touch = touch || (evt.pointerType == 'touch' ? evt : null);

                    if (touch) {
                        // Touch device support
                        tapEvt = {
                            target: dragEl,
                            clientX: touch.clientX,
                            clientY: touch.clientY
                        };

                        this._onDragStart(tapEvt, 'touch');
                    }
                    else if (!this.nativeDraggable) {
                        this._onDragStart(tapEvt, true);
                    }
                    else {
                        _on(dragEl, 'dragend', this);
                        _on(rootEl, 'dragstart', this._onDragStart);
                    }

                    try {
                        if (document.selection) {
                            // Timeout neccessary for IE9
                            setTimeout(function () {
                                document.selection.empty();
                            });
                        } else {
                            window.getSelection().removeAllRanges();
                        }
                    } catch (err) {
                    }
                },

                _dragStarted: function () {
                    if (rootEl && dragEl) {
                        var options = this.options;

                        // Apply effect
                        _toggleClass(dragEl, options.ghostClass, true);
                        _toggleClass(dragEl, options.dragClass, false);

                        Sortable.active = this;

                        // Drag start event
                        _dispatchEvent(this, rootEl, 'start', dragEl, rootEl, oldIndex);
                    } else {
                        this._nulling();
                    }
                },

                _emulateDragOver: function () {
                    if (touchEvt) {
                        if (this._lastX === touchEvt.clientX && this._lastY === touchEvt.clientY) {
                            return;
                        }

                        this._lastX = touchEvt.clientX;
                        this._lastY = touchEvt.clientY;

                        if (!supportCssPointerEvents) {
                            _css(ghostEl, 'display', 'none');
                        }

                        var target = document.elementFromPoint(touchEvt.clientX, touchEvt.clientY),
                            parent = target,
                            i = touchDragOverListeners.length;

                        if (parent) {
                            do {
                                if (parent[expando]) {
                                    while (i--) {
                                        touchDragOverListeners[i]({
                                            clientX: touchEvt.clientX,
                                            clientY: touchEvt.clientY,
                                            target: target,
                                            rootEl: parent
                                        });
                                    }

                                    break;
                                }

                                target = parent; // store last element
                            }
                            /* jshint boss:true */
                            while (parent = parent.parentNode);
                        }

                        if (!supportCssPointerEvents) {
                            _css(ghostEl, 'display', '');
                        }
                    }
                },


                _onTouchMove: function (/**TouchEvent*/evt) {
                    if (tapEvt) {
                        var	options = this.options,
                            fallbackTolerance = options.fallbackTolerance,
                            fallbackOffset = options.fallbackOffset,
                            touch = evt.touches ? evt.touches[0] : evt,
                            dx = (touch.clientX - tapEvt.clientX) + fallbackOffset.x,
                            dy = (touch.clientY - tapEvt.clientY) + fallbackOffset.y,
                            translate3d = evt.touches ? 'translate3d(' + dx + 'px,' + dy + 'px,0)' : 'translate(' + dx + 'px,' + dy + 'px)';

                        // only set the status to dragging, when we are actually dragging
                        if (!Sortable.active) {
                            if (fallbackTolerance &&
                                min(abs(touch.clientX - this._lastX), abs(touch.clientY - this._lastY)) < fallbackTolerance
                            ) {
                                return;
                            }

                            this._dragStarted();
                        }

                        // as well as creating the ghost element on the document body
                        this._appendGhost();

                        moved = true;
                        touchEvt = touch;

                        _css(ghostEl, 'webkitTransform', translate3d);
                        _css(ghostEl, 'mozTransform', translate3d);
                        _css(ghostEl, 'msTransform', translate3d);
                        _css(ghostEl, 'transform', translate3d);

                        evt.preventDefault();
                    }
                },

                _appendGhost: function () {
                    if (!ghostEl) {
                        var rect = dragEl.getBoundingClientRect(),
                            css = _css(dragEl),
                            options = this.options,
                            ghostRect;

                        ghostEl = dragEl.cloneNode(true);

                        _toggleClass(ghostEl, options.ghostClass, false);
                        _toggleClass(ghostEl, options.fallbackClass, true);
                        _toggleClass(ghostEl, options.dragClass, true);

                        _css(ghostEl, 'top', rect.top - parseInt(css.marginTop, 10));
                        _css(ghostEl, 'left', rect.left - parseInt(css.marginLeft, 10));
                        _css(ghostEl, 'width', rect.width);
                        _css(ghostEl, 'height', rect.height);
                        _css(ghostEl, 'opacity', '0.8');
                        _css(ghostEl, 'position', 'fixed');
                        _css(ghostEl, 'zIndex', '100000');
                        _css(ghostEl, 'pointerEvents', 'none');

                        options.fallbackOnBody && document.body.appendChild(ghostEl) || rootEl.appendChild(ghostEl);

                        // Fixing dimensions.
                        ghostRect = ghostEl.getBoundingClientRect();
                        _css(ghostEl, 'width', rect.width * 2 - ghostRect.width);
                        _css(ghostEl, 'height', rect.height * 2 - ghostRect.height);
                    }
                },

                _onDragStart: function (/**Event*/evt, /**boolean*/useFallback) {
                    var dataTransfer = evt.dataTransfer,
                        options = this.options;

                    this._offUpEvents();

                    if (activeGroup.checkPull(this, this, dragEl, evt)) {
                        cloneEl = _clone(dragEl);

                        cloneEl.draggable = false;
                        cloneEl.style['will-change'] = '';

                        _css(cloneEl, 'display', 'none');
                        _toggleClass(cloneEl, this.options.chosenClass, false);

                        rootEl.insertBefore(cloneEl, dragEl);
                        _dispatchEvent(this, rootEl, 'clone', dragEl);
                    }

                    _toggleClass(dragEl, options.dragClass, true);

                    if (useFallback) {
                        if (useFallback === 'touch') {
                            // Bind touch events
                            _on(document, 'touchmove', this._onTouchMove);
                            _on(document, 'touchend', this._onDrop);
                            _on(document, 'touchcancel', this._onDrop);
                            _on(document, 'pointermove', this._onTouchMove);
                            _on(document, 'pointerup', this._onDrop);
                        } else {
                            // Old brwoser
                            _on(document, 'mousemove', this._onTouchMove);
                            _on(document, 'mouseup', this._onDrop);
                        }

                        this._loopId = setInterval(this._emulateDragOver, 50);
                    }
                    else {
                        if (dataTransfer) {
                            dataTransfer.effectAllowed = 'move';
                            options.setData && options.setData.call(this, dataTransfer, dragEl);
                        }

                        _on(document, 'drop', this);
                        setTimeout(this._dragStarted, 0);
                    }
                },

                _onDragOver: function (/**Event*/evt) {
                    var el = this.el,
                        target,
                        dragRect,
                        targetRect,
                        revert,
                        options = this.options,
                        group = options.group,
                        activeSortable = Sortable.active,
                        isOwner = (activeGroup === group),
                        isMovingBetweenSortable = false,
                        canSort = options.sort;

                    if (evt.preventDefault !== void 0) {
                        evt.preventDefault();
                        !options.dragoverBubble && evt.stopPropagation();
                    }

                    if (dragEl.animated) {
                        return;
                    }

                    moved = true;

                    if (activeSortable && !options.disabled &&
                        (isOwner
                            ? canSort || (revert = !rootEl.contains(dragEl)) // Reverting item into the original list
                            : (
                                putSortable === this ||
                                (
                                    (activeSortable.lastPullMode = activeGroup.checkPull(this, activeSortable, dragEl, evt)) &&
                                    group.checkPut(this, activeSortable, dragEl, evt)
                                )
                            )
                        ) &&
                        (evt.rootEl === void 0 || evt.rootEl === this.el) // touch fallback
                    ) {
                        // Smart auto-scrolling
                        _autoScroll(evt, options, this.el);

                        if (_silent) {
                            return;
                        }

                        target = _closest(evt.target, options.draggable, el);
                        dragRect = dragEl.getBoundingClientRect();

                        if (putSortable !== this) {
                            putSortable = this;
                            isMovingBetweenSortable = true;
                        }

                        if (revert) {
                            _cloneHide(activeSortable, true);
                            parentEl = rootEl; // actualization

                            if (cloneEl || nextEl) {
                                rootEl.insertBefore(dragEl, cloneEl || nextEl);
                            }
                            else if (!canSort) {
                                rootEl.appendChild(dragEl);
                            }

                            return;
                        }


                        if ((el.children.length === 0) || (el.children[0] === ghostEl) ||
                            (el === evt.target) && (_ghostIsLast(el, evt))
                        ) {
                            //assign target only if condition is true
                            if (el.children.length !== 0 && el.children[0] !== ghostEl && el === evt.target) {
                                target = el.lastElementChild;
                            }

                            if (target) {
                                if (target.animated) {
                                    return;
                                }

                                targetRect = target.getBoundingClientRect();
                            }

                            _cloneHide(activeSortable, isOwner);

                            if (_onMove(rootEl, el, dragEl, dragRect, target, targetRect, evt) !== false) {
                                if (!dragEl.contains(el)) {
                                    el.appendChild(dragEl);
                                    parentEl = el; // actualization
                                }

                                this._animate(dragRect, dragEl);
                                target && this._animate(targetRect, target);
                            }
                        }
                        else if (target && !target.animated && target !== dragEl && (target.parentNode[expando] !== void 0)) {
                            if (lastEl !== target) {
                                lastEl = target;
                                lastCSS = _css(target);
                                lastParentCSS = _css(target.parentNode);
                            }

                            targetRect = target.getBoundingClientRect();

                            var width = targetRect.right - targetRect.left,
                                height = targetRect.bottom - targetRect.top,
                                floating = R_FLOAT.test(lastCSS.cssFloat + lastCSS.display)
                                    || (lastParentCSS.display == 'flex' && lastParentCSS['flex-direction'].indexOf('row') === 0),
                                isWide = (target.offsetWidth > dragEl.offsetWidth),
                                isLong = (target.offsetHeight > dragEl.offsetHeight),
                                halfway = (floating ? (evt.clientX - targetRect.left) / width : (evt.clientY - targetRect.top) / height) > 0.5,
                                nextSibling = target.nextElementSibling,
                                after = false
                            ;

                            if (floating) {
                                var elTop = dragEl.offsetTop,
                                    tgTop = target.offsetTop;

                                if (elTop === tgTop) {
                                    after = (target.previousElementSibling === dragEl) && !isWide || halfway && isWide;
                                }
                                else if (target.previousElementSibling === dragEl || dragEl.previousElementSibling === target) {
                                    after = (evt.clientY - targetRect.top) / height > 0.5;
                                } else {
                                    after = tgTop > elTop;
                                }
                                } else if (!isMovingBetweenSortable) {
                                after = (nextSibling !== dragEl) && !isLong || halfway && isLong;
                            }

                            var moveVector = _onMove(rootEl, el, dragEl, dragRect, target, targetRect, evt, after);

                            if (moveVector !== false) {
                                if (moveVector === 1 || moveVector === -1) {
                                    after = (moveVector === 1);
                                }

                                _silent = true;
                                setTimeout(_unsilent, 30);

                                _cloneHide(activeSortable, isOwner);

                                if (!dragEl.contains(el)) {
                                    if (after && !nextSibling) {
                                        el.appendChild(dragEl);
                                    } else {
                                        target.parentNode.insertBefore(dragEl, after ? nextSibling : target);
                                    }
                                }

                                parentEl = dragEl.parentNode; // actualization

                                this._animate(dragRect, dragEl);
                                this._animate(targetRect, target);
                            }
                        }
                    }
                },

                _animate: function (prevRect, target) {
                    var ms = this.options.animation;

                    if (ms) {
                        var currentRect = target.getBoundingClientRect();

                        if (prevRect.nodeType === 1) {
                            prevRect = prevRect.getBoundingClientRect();
                        }

                        _css(target, 'transition', 'none');
                        _css(target, 'transform', 'translate3d('
                            + (prevRect.left - currentRect.left) + 'px,'
                            + (prevRect.top - currentRect.top) + 'px,0)'
                        );

                        target.offsetWidth; // repaint

                        _css(target, 'transition', 'all ' + ms + 'ms');
                        _css(target, 'transform', 'translate3d(0,0,0)');

                        clearTimeout(target.animated);
                        target.animated = setTimeout(function () {
                            _css(target, 'transition', '');
                            _css(target, 'transform', '');
                            target.animated = false;
                        }, ms);
                    }
                },

                _offUpEvents: function () {
                    var ownerDocument = this.el.ownerDocument;

                    _off(document, 'touchmove', this._onTouchMove);
                    _off(document, 'pointermove', this._onTouchMove);
                    _off(ownerDocument, 'mouseup', this._onDrop);
                    _off(ownerDocument, 'touchend', this._onDrop);
                    _off(ownerDocument, 'pointerup', this._onDrop);
                    _off(ownerDocument, 'touchcancel', this._onDrop);
                    _off(ownerDocument, 'pointercancel', this._onDrop);
                    _off(ownerDocument, 'selectstart', this);
                },

                _onDrop: function (/**Event*/evt) {
                    var el = this.el,
                        options = this.options;

                    clearInterval(this._loopId);
                    clearInterval(autoScroll.pid);
                    clearTimeout(this._dragStartTimer);

                    // Unbind events
                    _off(document, 'mousemove', this._onTouchMove);

                    if (this.nativeDraggable) {
                        _off(document, 'drop', this);
                        _off(el, 'dragstart', this._onDragStart);
                    }

                    this._offUpEvents();

                    if (evt) {
                        if (moved) {
                            evt.preventDefault();
                            !options.dropBubble && evt.stopPropagation();
                        }

                        ghostEl && ghostEl.parentNode && ghostEl.parentNode.removeChild(ghostEl);

                        if (rootEl === parentEl || Sortable.active.lastPullMode !== 'clone') {
                            // Remove clone
                            cloneEl && cloneEl.parentNode && cloneEl.parentNode.removeChild(cloneEl);
                        }

                        if (dragEl) {
                            if (this.nativeDraggable) {
                                _off(dragEl, 'dragend', this);
                            }

                            _disableDraggable(dragEl);
                            dragEl.style['will-change'] = '';

                            // Remove class's
                            _toggleClass(dragEl, this.options.ghostClass, false);
                            _toggleClass(dragEl, this.options.chosenClass, false);

                            // Drag stop event
                            _dispatchEvent(this, rootEl, 'unchoose', dragEl, rootEl, oldIndex);

                            if (rootEl !== parentEl) {
                                newIndex = _index(dragEl, options.draggable);

                                if (newIndex >= 0) {
                                    // Add event
                                    _dispatchEvent(null, parentEl, 'add', dragEl, rootEl, oldIndex, newIndex);

                                    // Remove event
                                    _dispatchEvent(this, rootEl, 'remove', dragEl, rootEl, oldIndex, newIndex);

                                    // drag from one list and drop into another
                                    _dispatchEvent(null, parentEl, 'sort', dragEl, rootEl, oldIndex, newIndex);
                                    _dispatchEvent(this, rootEl, 'sort', dragEl, rootEl, oldIndex, newIndex);
                                }
                            }
                            else {
                                if (dragEl.nextSibling !== nextEl) {
                                    // Get the index of the dragged element within its parent
                                    newIndex = _index(dragEl, options.draggable);

                                    if (newIndex >= 0) {
                                        // drag & drop within the same list
                                        _dispatchEvent(this, rootEl, 'update', dragEl, rootEl, oldIndex, newIndex);
                                        _dispatchEvent(this, rootEl, 'sort', dragEl, rootEl, oldIndex, newIndex);
                                    }
                                }
                            }

                            if (Sortable.active) {
                                /* jshint eqnull:true */
                                if (newIndex == null || newIndex === -1) {
                                    newIndex = oldIndex;
                                }

                                _dispatchEvent(this, rootEl, 'end', dragEl, rootEl, oldIndex, newIndex);

                                // Save sorting
                                this.save();
                            }
                        }

                    }

                    this._nulling();
                },

                _nulling: function() {
                    rootEl =
                    dragEl =
                    parentEl =
                    ghostEl =
                    nextEl =
                    cloneEl =
                    lastDownEl =

                    scrollEl =
                    scrollParentEl =

                    tapEvt =
                    touchEvt =

                    moved =
                    newIndex =

                    lastEl =
                    lastCSS =

                    putSortable =
                    activeGroup =
                    Sortable.active = null;

                    savedInputChecked.forEach(function (el) {
                        el.checked = true;
                    });
                    savedInputChecked.length = 0;
                },

                handleEvent: function (/**Event*/evt) {
                    switch (evt.type) {
                        case 'drop':
                        case 'dragend':
                            this._onDrop(evt);
                            break;

                        case 'dragover':
                        case 'dragenter':
                            if (dragEl) {
                                this._onDragOver(evt);
                                _globalDragOver(evt);
                            }
                            break;

                        case 'selectstart':
                            evt.preventDefault();
                            break;
                    }
                },


                /**
                 * Serializes the item into an array of string.
                 * @returns {String[]}
                 */
                toArray: function () {
                    var order = [],
                        el,
                        children = this.el.children,
                        i = 0,
                        n = children.length,
                        options = this.options;

                    for (; i < n; i++) {
                        el = children[i];
                        if (_closest(el, options.draggable, this.el)) {
                            order.push(el.getAttribute(options.dataIdAttr) || _generateId(el));
                        }
                    }

                    return order;
                },


                /**
                 * Sorts the elements according to the array.
                 * @param  {String[]}  order  order of the items
                 */
                sort: function (order) {
                    var items = {}, rootEl = this.el;

                    this.toArray().forEach(function (id, i) {
                        var el = rootEl.children[i];

                        if (_closest(el, this.options.draggable, rootEl)) {
                            items[id] = el;
                        }
                    }, this);

                    order.forEach(function (id) {
                        if (items[id]) {
                            rootEl.removeChild(items[id]);
                            rootEl.appendChild(items[id]);
                        }
                    });
                },


                /**
                 * Save the current sorting
                 */
                save: function () {
                    var store = this.options.store;
                    store && store.set(this);
                },


                /**
                 * For each element in the set, get the first element that matches the selector by testing the element itself and traversing up through its ancestors in the DOM tree.
                 * @param   {HTMLElement}  el
                 * @param   {String}       [selector]  default: `options.draggable`
                 * @returns {HTMLElement|null}
                 */
                closest: function (el, selector) {
                    return _closest(el, selector || this.options.draggable, this.el);
                },


                /**
                 * Set/get option
                 * @param   {string} name
                 * @param   {*}      [value]
                 * @returns {*}
                 */
                option: function (name, value) {
                    var options = this.options;

                    if (value === void 0) {
                        return options[name];
                    } else {
                        options[name] = value;

                        if (name === 'group') {
                            _prepareGroup(options);
                        }
                    }
                },


                /**
                 * Destroy
                 */
                destroy: function () {
                    var el = this.el;

                    el[expando] = null;

                    _off(el, 'mousedown', this._onTapStart);
                    _off(el, 'touchstart', this._onTapStart);
                    _off(el, 'pointerdown', this._onTapStart);

                    if (this.nativeDraggable) {
                        _off(el, 'dragover', this);
                        _off(el, 'dragenter', this);
                    }

                    // Remove draggable attributes
                    Array.prototype.forEach.call(el.querySelectorAll('[draggable]'), function (el) {
                        el.removeAttribute('draggable');
                    });

                    touchDragOverListeners.splice(touchDragOverListeners.indexOf(this._onDragOver), 1);

                    this._onDrop();

                    this.el = el = null;
                }
            };


            function _cloneHide(sortable, state) {
                if (sortable.lastPullMode !== 'clone') {
                    state = true;
                }

                if (cloneEl && (cloneEl.state !== state)) {
                    _css(cloneEl, 'display', state ? 'none' : '');

                    if (!state) {
                        if (cloneEl.state) {
                            if (sortable.options.group.revertClone) {
                                rootEl.insertBefore(cloneEl, nextEl);
                                sortable._animate(dragEl, cloneEl);
                            } else {
                                rootEl.insertBefore(cloneEl, dragEl);
                            }
                        }
                    }

                    cloneEl.state = state;
                }
            }


            function _closest(/**HTMLElement*/el, /**String*/selector, /**HTMLElement*/ctx) {
                if (el) {
                    ctx = ctx || document;

                    do {
                        if ((selector === '>*' && el.parentNode === ctx) || _matches(el, selector)) {
                            return el;
                        }
                        /* jshint boss:true */
                    } while (el = _getParentOrHost(el));
                }

                return null;
            }


            function _getParentOrHost(el) {
                var parent = el.host;

                return (parent && parent.nodeType) ? parent : el.parentNode;
            }


            function _globalDragOver(/**Event*/evt) {
                if (evt.dataTransfer) {
                    evt.dataTransfer.dropEffect = 'move';
                }
                evt.preventDefault();
            }


            function _on(el, event, fn) {
                el.addEventListener(event, fn, captureMode);
            }


            function _off(el, event, fn) {
                el.removeEventListener(event, fn, captureMode);
            }


            function _toggleClass(el, name, state) {
                if (el) {
                    if (el.classList) {
                        el.classList[state ? 'add' : 'remove'](name);
                    }
                    else {
                        var className = (' ' + el.className + ' ').replace(R_SPACE, ' ').replace(' ' + name + ' ', ' ');
                        el.className = (className + (state ? ' ' + name : '')).replace(R_SPACE, ' ');
                    }
                }
            }


            function _css(el, prop, val) {
                var style = el && el.style;

                if (style) {
                    if (val === void 0) {
                        if (document.defaultView && document.defaultView.getComputedStyle) {
                            val = document.defaultView.getComputedStyle(el, '');
                        }
                        else if (el.currentStyle) {
                            val = el.currentStyle;
                        }

                        return prop === void 0 ? val : val[prop];
                    }
                    else {
                        if (!(prop in style)) {
                            prop = '-webkit-' + prop;
                        }

                        style[prop] = val + (typeof val === 'string' ? '' : 'px');
                    }
                }
            }


            function _find(ctx, tagName, iterator) {
                if (ctx) {
                    var list = ctx.getElementsByTagName(tagName), i = 0, n = list.length;

                    if (iterator) {
                        for (; i < n; i++) {
                            iterator(list[i], i);
                        }
                    }

                    return list;
                }

                return [];
            }



            function _dispatchEvent(sortable, rootEl, name, targetEl, fromEl, startIndex, newIndex) {
                sortable = (sortable || rootEl[expando]);

                var evt = document.createEvent('Event'),
                    options = sortable.options,
                    onName = 'on' + name.charAt(0).toUpperCase() + name.substr(1);

                evt.initEvent(name, true, true);

                evt.to = rootEl;
                evt.from = fromEl || rootEl;
                evt.item = targetEl || rootEl;
                evt.clone = cloneEl;

                evt.oldIndex = startIndex;
                evt.newIndex = newIndex;

                rootEl.dispatchEvent(evt);

                if (options[onName]) {
                    options[onName].call(sortable, evt);
                }
            }


            function _onMove(fromEl, toEl, dragEl, dragRect, targetEl, targetRect, originalEvt, willInsertAfter) {
                var evt,
                    sortable = fromEl[expando],
                    onMoveFn = sortable.options.onMove,
                    retVal;

                evt = document.createEvent('Event');
                evt.initEvent('move', true, true);

                evt.to = toEl;
                evt.from = fromEl;
                evt.dragged = dragEl;
                evt.draggedRect = dragRect;
                evt.related = targetEl || toEl;
                evt.relatedRect = targetRect || toEl.getBoundingClientRect();
                evt.willInsertAfter = willInsertAfter;

                fromEl.dispatchEvent(evt);

                if (onMoveFn) {
                    retVal = onMoveFn.call(sortable, evt, originalEvt);
                }

                return retVal;
            }


            function _disableDraggable(el) {
                el.draggable = false;
            }


            function _unsilent() {
                _silent = false;
            }


            /** @returns {HTMLElement|false} */
            function _ghostIsLast(el, evt) {
                var lastEl = el.lastElementChild,
                    rect = lastEl.getBoundingClientRect();

                // 5 â€” min delta
                // abs â€” Ð½ÐµÐ»ÑŒÐ·Ñ Ð´Ð¾Ð±Ð°Ð²Ð»ÑÑ‚ÑŒ, Ð° Ñ‚Ð¾ Ð³Ð»ÑŽÐºÐ¸ Ð¿Ñ€Ð¸ Ð½Ð°Ð²ÐµÐ´ÐµÐ½Ð¸Ð¸ ÑÐ²ÐµÑ€Ñ…Ñƒ
                return (evt.clientY - (rect.top + rect.height) > 5) ||
                    (evt.clientX - (rect.left + rect.width) > 5);
            }


            /**
             * Generate id
             * @param   {HTMLElement} el
             * @returns {String}
             * @private
             */
            function _generateId(el) {
                var str = el.tagName + el.className + el.src + el.href + el.textContent,
                    i = str.length,
                    sum = 0;

                while (i--) {
                    sum += str.charCodeAt(i);
                }

                return sum.toString(36);
            }

            /**
             * Returns the index of an element within its parent for a selected set of
             * elements
             * @param  {HTMLElement} el
             * @param  {selector} selector
             * @return {number}
             */
            function _index(el, selector) {
                var index = 0;

                if (!el || !el.parentNode) {
                    return -1;
                }

                while (el && (el = el.previousElementSibling)) {
                    if ((el.nodeName.toUpperCase() !== 'TEMPLATE') && (selector === '>*' || _matches(el, selector))) {
                        index++;
                    }
                }

                return index;
            }

            function _matches(/**HTMLElement*/el, /**String*/selector) {
                if (el) {
                    selector = selector.split('.');

                    var tag = selector.shift().toUpperCase(),
                        re = new RegExp('\\s(' + selector.join('|') + ')(?=\\s)', 'g');

                    return (
                        (tag === '' || el.nodeName.toUpperCase() == tag) &&
                        (!selector.length || ((' ' + el.className + ' ').match(re) || []).length == selector.length)
                    );
                }

                return false;
            }

            function _throttle(callback, ms) {
                var args, _this;

                return function () {
                    if (args === void 0) {
                        args = arguments;
                        _this = this;

                        setTimeout(function () {
                            if (args.length === 1) {
                                callback.call(_this, args[0]);
                            } else {
                                callback.apply(_this, args);
                            }

                            args = void 0;
                        }, ms);
                    }
                };
            }

            function _extend(dst, src) {
                if (dst && src) {
                    for (var key in src) {
                        if (src.hasOwnProperty(key)) {
                            dst[key] = src[key];
                        }
                    }
                }

                return dst;
            }

            function _clone(el) {
                return $
                    ? $(el).clone(true)[0]
                    : (Polymer && Polymer.dom
                        ? Polymer.dom(el).cloneNode(true)
                        : el.cloneNode(true)
                    );
            }

            function _saveInputCheckedState(root) {
                var inputs = root.getElementsByTagName('input');
                var idx = inputs.length;

                while (idx--) {
                    var el = inputs[idx];
                    el.checked && savedInputChecked.push(el);
                }
            }

            // Fixed #973: 
            _on(document, 'touchmove', function (evt) {
                if (Sortable.active) {
                    evt.preventDefault();
                }
            });

            try {
                window.addEventListener('test', null, Object.defineProperty({}, 'passive', {
                    get: function () {
                        captureMode = {
                            capture: false,
                            passive: false
                        };
                    }
                }));
            } catch (err) {}

            // Export utils
            Sortable.utils = {
                on: _on,
                off: _off,
                css: _css,
                find: _find,
                is: function (el, selector) {
                    return !!_closest(el, selector, el);
                },
                extend: _extend,
                throttle: _throttle,
                closest: _closest,
                toggleClass: _toggleClass,
                clone: _clone,
                index: _index
            };


            /**
             * Create sortable instance
             * @param {HTMLElement}  el
             * @param {Object}      [options]
             */
            Sortable.create = function (el, options) {
                return new Sortable(el, options);
            };


            // Export
            Sortable.version = '1.6.1';
            return Sortable;
        });



        function createSortTable() {
            $('table.table-sort-by-column').each(function(index, element) {
                let thisTable = $(this);
                let self = thisTable.attr('data-self-name');
                let originalURL = document.location.toString();
                let arr0 = originalURL.split('#');
                originalURL = arr0[0];
                let arr1 = originalURL.split('?');
                originalURL = arr1[0];
                let args = arr1[1] || '';
                let argArray = args.split('&');
                let queryObject = {};
                for (let i in argArray) {
                    let arr2 = argArray[i].split('=');
                    if (arr2[0] != '') {
                        queryObject[arr2[0]] = arr2[1];
                    }
                }
                let currentOrderMethod = queryObject.ordertype || '';
                let lastColumn = queryObject.orderby || '';
                thisTable.find('td.order-controll').each(function (index, element) {
                    let thisCel = $(this);
                    let columnName = thisCel.attr('data-col-name');
                    if (lastColumn == columnName) {

                        if (currentOrderMethod == 'asc') {
                            queryObject.ordertype = 'desc'
                            thisCel.attr('data-order-method', 'asc');
                        } else if (currentOrderMethod == 'desc') {
                            queryObject.ordertype = 'asc'
                            thisCel.attr('data-order-method', 'desc');
                        } else {
                            queryObject.ordertype = 'asc'
                            thisCel.attr('data-order-method', 'desc');
                        }
                    } else {
                        queryObject.ordertype = 'asc'
                    }
                    queryObject.orderby = columnName;
                    let arr3 = [];
                    for (let j in queryObject) {
                        arr3.push(j + '=' + queryObject[j]);
                    }
                    let args3 = arr3.join('&');
                    let finalURL = originalURL + '?' + args3;
                    thisCel.find(' > a').attr('href', finalURL);
                });
            });
        }
        jQuery(function ($) {
            createSortTable();
            $('tbody.data-table-manual-sort').each(function(){
                let dataToSort = $(this)[0];
                Sortable.create(
                    dataToSort,
                    {
                        animation: 150,
                        scroll: true,
                        handle: '.data-sort-handler',
                        onEnd: function () {
                            // do nothing
                            updateNumber($(dataToSort));
                        }
                    }
                );
            });


            $('table').each(function(){
                if($('.check-master').length > 0)
                {
                    
                    $('.check-master').each(function(){
                        $(this).on('change', function(){
                            let checked = $(this)[0].checked;
                            let table = $(this).closest('table');
                            table.find('.check-slave').each(function(){
                                $(this)[0].checked =checked;
                            })
                        });
                    });
                }
            })
            
        });
        function updateNumber(dataToSort)
        {
            let frm = dataToSort.closest('form');
            if(frm.find('span.new-sort-order').length)
            {
                frm.find('span.new-sort-order').remove();
            }
            let span = $('<span />');
            span.addClass('new-sort-order');
            frm.append(span);
            let offset = parseInt(dataToSort.attr('data-offset'));
            let i = 0;
            dataToSort.find('tr').each(function(e){
                let tr = $(this);
                i++;
                let order = offset+i;
                tr.find('.data-number').text(order);
                let pk = tr.attr('data-primary-key');
                let orderInput = $('<input />');
                orderInput.attr({'type': 'hidden', 'name':'new_order[]', 'value':JSON.stringify({'primary_key':pk, 'sort_order':order})});
                span.append(orderInput);
                
            });
        }
        function saveOrder()
        {

        }
    </script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
                    aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse show" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item active" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="<?php echo $themePath;?>img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="<?php echo $themePath;?>img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="<?php echo $themePath;?>img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo $themePath;?>img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
