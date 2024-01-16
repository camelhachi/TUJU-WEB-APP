function getElementByIdSuffix(suffix, index) {
    return document.getElementById(suffix + index);
}

function updateCount(index, isIncrement) {
    var countSpan = getElementByIdSuffix('countSpan', index);
    var quantityInput = getElementByIdSuffix('quantityInput', index);

    if (!countSpan || !quantityInput) {
        console.error('Element not found for index:', index);
        return;
    }

    var currentCount = parseInt(countSpan.innerText, 10);

    if (isNaN(currentCount)) {
        console.error('Current count is NaN for index:', index);
        return;
    }

    if (isIncrement) {
        currentCount++;
    } else if (currentCount > 0) {
        currentCount--;
    }

    countSpan.innerText = currentCount.toString();
    quantityInput.value = currentCount.toString();
}

function increment(index) {
    updateCount(index, true);
}

function decrement(index) {
    updateCount(index, false);
}
