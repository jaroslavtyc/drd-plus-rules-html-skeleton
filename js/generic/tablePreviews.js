var removeIdsFromElement = function (element) {
    element.id = '';
    for (var i = 0, childrenLength = element.children.length; i < childrenLength; i++) {
        removeIdsFromElement(element.children[i]);
    }
};

var removeAnchorsFromElement = function (element) {
    if (element.tagName === 'A') {
        element.onclick = function () {
            return false;
        }
    }
    for (var i = 0, childrenLength = element.children.length; i < childrenLength; i++) {
        var child = element.children[i];
        if (child.tagName === 'A') {
            var replacement = document.createElement('span');
            replacement.innerHTML = child.innerHTML;
            element.replaceChild(replacement, child);
        } else {
            removeAnchorsFromElement(element.children[i]);
        }
    }
};

var showPreview = function (onElement, pinIt, getElementByIdForPreview) {
    var previewWrapped = onElement.getElementsByClassName('preview');
    var preview;
    if (previewWrapped.length > 0) {
        preview = previewWrapped[0];
        preview.className = preview.className.replace('hidden', '').trim(); // reveal if hidden
    } else {
        preview = document.createElement('div');
        preview.className = 'preview';
        var linkedTable = getElementByIdForPreview(onElement.href.replace(/^.*#/, ''));
        if (!linkedTable) {
            console.log('No linked element found for ' + onElement.href);
            return false;
        }
        preview.appendChild(linkedTable);
        onElement.appendChild(preview); // add newly created
    }
    if (pinIt) {
        preview.className += ' pinned';
    }

    return true;
};

var togglePreview = function (onElement, getElementByIdForPreview) {
    var wrappedPreview = onElement.getElementsByClassName('preview');
    if (wrappedPreview.length === 0) {
        return showPreview(onElement, true, getElementByIdForPreview);
    }
    var preview = wrappedPreview[0];
    if (preview.className.includes('hidden') || !preview.className.includes('pinned')) {
        return showPreview(onElement, true, getElementByIdForPreview);
    }
    if (!preview.className.includes('hidden')) {
        preview.className += ' hidden';
    }
    preview.className = preview.className.replace('pinned', '').trim();

    return true;
};

var addPreviewToInnerLinks = function (isRequiredAnchor, getElementByIdForPreview) {
    var anchors = document.getElementsByTagName('a');
    for (var i = 0, anchorsLength = anchors.length; i < anchorsLength; i++) {
        var anchor = anchors[i];
        if (!isRequiredAnchor(anchor)) {
            continue;
        }
        anchor.addEventListener('click', function (event) {
            if (togglePreview(this)) {
                event.preventDefault();
                event.stopPropagation();
                return false;
            }
        });
        anchor.addEventListener('mouseover', function () {
            showPreview(this, false, getElementByIdForPreview);
        });
        anchor.addEventListener('mouseout', function () { // hide on mouse out
            var previewWrapped = this.getElementsByClassName('preview');
            if (previewWrapped.length === 0) {
                console.log('Can not find .preview for anchor ' + this.href);
                return;
            }
            var tablePreview = previewWrapped[0];
            if (!tablePreview.className.includes('hidden') && !tablePreview.className.includes('pinned')) {
                tablePreview.className += ' hidden';
            }
        });
    }
};


var elementParentIsTable = function (element) {
    var parent = element.parentNode;
    while (parent.tagName !== 'TABLE' && parent.tagName !== 'BODY') {
        parent = parent.parentNode;
    }
    return parent.tagName === 'TABLE';
};

var isAnchorToTable = function (anchor) {
    return anchor.href !== 'undefined' && anchor.href
        && (anchor.href.includes('#tabulka') || anchor.href.includes('#Tabulka'))
        && !elementParentIsTable(anchor);
};

var getTableByIdForPreview = function (inTableElementId) {
    if (inTableElementId === 'undefined' || !inTableElementId) {
        console.log('Missing ID of an element in a table');
        return '';
    }
    var element = document.getElementById(inTableElementId);
    if (element === 'undefined' || !element) {
        console.log('Element in a table not found by ID ' + inTableElementId);
        return '';
    }
    var searchedTable = element;
    while (searchedTable.tagName !== 'TABLE' && searchedTable.tagName !== 'BODY') {
        searchedTable = searchedTable.parentNode;
    }
    if (searchedTable.tagName !== 'TABLE') {
        console.log('Wrapping table not found for an element with ID ' + inTableElementId);
        return '';
    }
    var table = searchedTable.cloneNode(true);
    removeIdsFromElement(table);
    removeAnchorsFromElement(table);

    return table;
};

window.addEventListener(
    'load',
    function () {
        addPreviewToInnerLinks(isAnchorToTable, getTableByIdForPreview);
    }
);