//Product Create/Edit page shared js Start--->>
// Shared by both create.blade.php and edit.blade.php. SKU auto-generation
// (previously at the bottom of this file) is create-only and now lives inline
// on create.blade.php: including it here unconditionally used to overwrite
// the edit page's existing SKU input with a freshly generated random value
// on every page load, even though the field is marked readonly (readonly only
// blocks user typing, not `.value = ...` from script).

// Brand/Category use select2 (main.js .select-nice), which hides the native
// <select> and drives it entirely through synthetic events. jQuery Validate
// only re-checks a field on focusin/focusout/keyup/click of the *native*
// element, none of which fire when a Select2 option is picked - so choosing
// a valid brand/category left the stale "This field is required." label on
// screen even though the picked value was actually valid (the wizard's Next/
// Publish buttons re-validate the whole form on click and were never
// actually blocked by this - it was a display-only bug). Re-run this field's
// own check whenever select2 reports a change.
// Deferred to DOMContentLoaded rather than run inline: this is the first
// jQuery call in the file, and jQuery/select2 aren't reliably ready the
// instant this <script> tag is parsed (unrelated page-wide script ordering),
// so a top-level $(...) call here could throw before jQuery loads at all.
document.addEventListener('DOMContentLoaded', function () {
    if (typeof $ === 'undefined') {
        return;
    }
    $(document).on('select2:select select2:unselect select2:clear', '#product_brand, #product_category', function () {
        var $form = $(this).closest('form');
        if ($form.length && $form.data('validator')) {
            $form.validate().element(this);
        }
    });
});

// Seeded from the hidden totinput/totinput2 fields rather than hardcoded, so
// rows already rendered server-side (edit page's saved overviews, or a
// create-page reload after a failed submit repopulating old() rows) don't
// get their name="featurename[N]"/"additional_name[N]" collided with by the
// next JS-added row reusing the same N.
var totInputEl = document.querySelector('#totfield input[name="totinput"]');
var i = totInputEl ? parseInt(totInputEl.value, 10) || 1 : 1;
function addfield(){
    if (i < 5) {
        i++;
        var data = '<div class="row mt-2">'+
                '<div class="col-lg-4">'+
                    '<input class="form-control" type="text" id="featurename-'+i+'" name="featurename['+i+']" placeholder="Name">'+
                '</div>'+
                '<div class="col-lg-8">'+
                    '<input class="form-control" type="text" id="featurevalue-'+i+'" name="featurevalue['+i+']" placeholder="Value">'+
                '</div>'+
            '</div>';
    $("#morefield").append(data);
    var tot = '<input type="hidden" name="totinput" value="'+i+'">';
    $("#totfield").html(tot);
    } else {
        alert("Cannot add more than 5 rows.");
    }
}

function removeField() {
    if (i > 1) {
        $("#morefield .row:last").remove(); // Remove the last added row
        i--;

        // Update the hidden input value
        var tot = '<input type="hidden" name="totinput" value="' + i + '">';
        $("#totfield").html(tot);
    } else {
        alert("Cannot remove the last row. At least one row is required.");
    }
}


var totInput2El = document.querySelector('#totfield2 input[name="totinput2"]');
var j = totInput2El ? Math.max(5, parseInt(totInput2El.value, 10) || 5) : 5;
function getfield(){
    var AdditionalName = document.getElementById('info_name').value;
        j++;
        var data = '<div class="row mb-3">'+
                '<div class="col-lg-4">'+
                    '<input class="form-control" type="text" readonly id="additional_name-'+j+'" name="additional_name['+j+']" value="'+AdditionalName+'">'+
                '</div>'+
                '<div class="col-lg-8 input-action">'+
                    '<input class="form-control" type="text" id="additional_value-'+j+'" name="additional_value['+j+']" placeholder="Enter require field Value.">'+
                    '<div class="btn-action ">'+
                    '<a class="rm-btn"  onclick="event.preventDefault();removegetField(this)"> <i class="fa-solid fa-times"></i> </a>'+
                    '</div>'+
                '</div>'+
            '</div>';
    $("#newfield").append(data);
    var tot = '<input type="hidden" name="totinput2" value="'+j+'">';
    $("#totfield2").html(tot);
    $('#additional_info').modal('hide');
}

function removegetField(button) {
    if (j > 5) {
        var rowToRemove = button.closest('.row');
        rowToRemove.remove();
        j--;

        // Update the hidden input value
        var tot = '<input type="hidden" name="totinput2" value="' + j + '">';
        $("#totfield2").html(tot);
    } else {
        alert("Cannot remove the last row.");
    }
}

// Live preview of newly selected files for the product images / thumbnail
// inputs, with a working remove button. Both create.blade.php and
// edit.blade.php used to carry their own copy of this logic inline (and its
// remove button only ever deleted the preview thumbnail: a browser's
// <input type=file multiple> FileList cannot be edited in place by script,
// so every originally selected file was still submitted regardless of what
// looked "removed" in the UI). Fixed here by keeping our own array of the
// currently-selected files and reassigning input.files via a DataTransfer
// whenever one is removed, so the browser's own upload list matches the
// preview the admin is looking at.
function wireImagePreview(inputId, previewContainerId) {
    var input = document.getElementById(inputId);
    var previewContainer = document.getElementById(previewContainerId);
    if (!input || !previewContainer) {
        return;
    }

    var selectedFiles = [];

    function render() {
        previewContainer.innerHTML = '';

        selectedFiles.forEach(function (file, index) {
            var reader = new FileReader();
            var imageDiv = document.createElement('div');
            imageDiv.className = 'col-lg-3 mb-4';

            var image = document.createElement('img');
            var removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.innerHTML = '<i class="fa-solid fa-times"></i>';
            removeButton.className = 'btn btn-danger btn-delete';
            removeButton.addEventListener('click', function () {
                selectedFiles.splice(index, 1);
                syncInputFiles();
                render();
            });

            reader.onload = function (e) {
                image.src = e.target.result;
            };
            reader.readAsDataURL(file);

            imageDiv.appendChild(image);
            imageDiv.appendChild(removeButton);
            previewContainer.appendChild(imageDiv);
        });
    }

    function syncInputFiles() {
        var dataTransfer = new DataTransfer();
        selectedFiles.forEach(function (file) {
            dataTransfer.items.add(file);
        });
        input.files = dataTransfer.files;
    }

    input.addEventListener('change', function (event) {
        selectedFiles = Array.from(event.target.files || []);
        render();
    });
}

document.addEventListener('DOMContentLoaded', function () {
    wireImagePreview('imageInput2', 'imagePreview2');
    wireImagePreview('imageInput3', 'imagePreview3');
});

// The show/hide behaviour for #variantFields and the offer-price inputs is
// wired in resources/views/layouts/admin.blade.php ($('#showVariantFields')
// .change(...) etc.), shared by every admin page including this form - that
// part already worked. What was missing: on the edit page, a product that
// already has a saved color/size or offer price loads with those checkboxes
// unchecked, so the fields holding its own saved data start hidden with no
// visible cue that they exist. Reveal the fields whenever their toggle is
// already checked (server-rendered based on saved data / old() input), once
// on load.
document.addEventListener('DOMContentLoaded', function () {
    var variantToggle = document.getElementById('showVariantFields');
    var variantFields = document.getElementById('variantFields');
    if (variantToggle && variantFields && variantFields.querySelector('option[selected]')) {
        variantToggle.checked = true;
        variantFields.style.display = '';
    }

    // percentage_checkbox/price_checkbox are a mutually-exclusive radio group
    // (offer_type); whichever one Blade already marked checked decides which
    // panel to reveal - no need to re-derive it from the input values here.
    var percentageCheckbox = document.getElementById('percentage_checkbox');
    var offerPriceDiv = document.querySelector('.offer-price');
    if (percentageCheckbox && percentageCheckbox.checked && offerPriceDiv) {
        offerPriceDiv.style.display = '';
    }

    var priceCheckbox = document.getElementById('price_checkbox');
    var offerPriceDiv2 = document.querySelector('.offer-price-2');
    if (priceCheckbox && priceCheckbox.checked && offerPriceDiv2) {
        offerPriceDiv2.style.display = '';
    }
});


// create tags

const ul = document.querySelector("ul.tag-content"),
    input = document.querySelector("input.tag-input"),
    tagsArrayInput = document.getElementById("tagsArrayInput"),
    tagNumb = document.querySelector(".tag-details span");

let maxTags = 10,
    // Seed from any tags already rendered server-side (edit page), so opening
    // edit and immediately saving doesn't wipe out the product's existing tags.
    tags = Array.from(document.querySelectorAll("ul.tag-content li")).map(function (li) {
        return li.firstChild ? li.firstChild.textContent.trim() : li.textContent.trim();
    });

countTags();
createTag();

function countTags() {
    input.focus();
    tagNumb.innerText = maxTags - tags.length;
    // Update the hidden input field with the serialized JSON of the tags array
    tagsArrayInput.value = tags;
}

function createTag() {
    ul.querySelectorAll("li").forEach((li) => li.remove());
    tags
        .slice()
        .reverse()
        .forEach((tag) => {
            let liTag = `<li>${tag} <i class="uit uit-multiply" onclick="removeTag(this, '${tag}')"></i></li>`;
            ul.insertAdjacentHTML("afterbegin", liTag);
        });
    countTags();
}

// Named removeTag rather than remove(): `remove` shadows the native
// Element.remove()/EventTarget global some libraries rely on, which is fragile
// as more script gets loaded onto the same page.
function removeTag(element, tag) {
    let index = tags.indexOf(tag);
    tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
    element.parentElement.remove();
    countTags();
}

function addTag(e) {
    if (e.key == "Enter" || e.keyCode == 32) {
        let tag = e.target.value.replace(/\s+/g, " ").trim();
        if (tag.length > 1 && !tags.includes(tag)) {
            if (tags.length < 10) {
                tag.split(",").forEach((tag) => {
                    tag = tag.trim();
                    if (tag.length > 1 && !tags.includes(tag)) {
                        tags.push(tag);
                    }
                });
                createTag();
            }
        }
        e.target.value = "";
    }
}

input.addEventListener("keyup", addTag);

const removeBtn = document.querySelector(".tag-details button");
removeBtn.addEventListener("click", () => {
    tags.length = 0;
    ul.querySelectorAll("li").forEach((li) => li.remove());
    countTags();
});
