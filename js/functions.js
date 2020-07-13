function hideAlert() {
    document.getElementById("alert-modal").style.display = "none";
}

function showAlert(success, text) {
    let alert_modal = document.getElementById("alert-modal");
    let alert_text = document.getElementById("alert-text");
    if(success) {
        alert_modal.classList.remove( "alert-warning");
        alert_modal.classList.add( "alert-success");
        alert_text.innerHTML = text;
    } else {
        alert_modal.classList.remove("alert-success");
        alert_modal.classList.add("alert-warning");
        alert_text.innerHTML = text;
    }

    alert_modal.style.display = "block";
}

function flipSubtitle() {
    let elem = document.getElementById("subtitle-container");
    if ( elem.className === "text-success") {
        elem.className = "text-warning";
        elem.textContent = "Thank you for your patience";
    } else {
        elem.className = "text-success";
        elem.textContent = "Enter your information and submit for assistance";
    }
}

function hideEnqueue() {
    document.getElementById("enqueue-container").style.display = "none";
}

function showEnqueue() {
    document.getElementById("enqueue-container").style.display = "inline-block"
}

// TODO actually get form fields
function get_form_fields() {
    return Array("name-field", "location-field", "course-field");
}

// TODO shrink this
function formError() {
    let err_str = "Please enter your ";
    let form_fields = get_form_fields();
    let err_fields = Array();
    for (let f in form_fields) {
        let elem = document.getElementById(form_fields[f]);
        if (elem.value === "") {
            err_fields.push(form_fields[f]);
        }
    }
    const err_len = err_fields.length;
    let err_count = 0;
    for (let val in err_fields) {
        let field_name = err_fields[val].substring(0, err_fields[val].indexOf("-"));
        err_str += (field_name);
        document.getElementById(err_fields[val]).className += " is-invalid";
        err_count += 1;
        if (err_len === 2 && err_count < 2) {
            err_str += (" and ");
        } else if (err_count === err_len - 1) {
            err_str += (", and ");
        } else if (err_count === err_len) {
            err_str += (".");
        } else {
            err_str += (", ");
        }
    }

    showAlert(false, err_str);

}

// TODO get fields programmatically
function enqueueAjax() {
    let uInput  = Array();
    uInput[0] = ($("#name-field").val());
    uInput[1] = ($("#course-field").val());
    uInput[2] = ($("#location-field").val());
    let err_in_form = false;
    for (let val in uInput) {
        if (uInput[val] === "") {
            err_in_form = true;
            break;
        }
    }

    if (err_in_form) {
        formError();
    } else {

        $.ajax({
            url: "php/queue.php",
            data: {
                enqueue: "1",
                name: uInput[0],
                course: uInput[1],
                location: uInput[2]
            },
            success: enqueueLineSitter
        });
    }
}

//
function enqueueLineSitter(result) {
    console.log(result);
    let resJson = JSON.parse(result);
    document.getElementById("user-number").textContent = resJson["uNumber"];
    document.getElementById("dequeue-button").addEventListener("click", function() {
        console.log(resJson["uID"]);
        dequeueAjax(resJson["uID"]);
    } );
    showAlert(true, "Successfully added to queue");
    flipSubtitle();
    hideEnqueue();
    showDequeue();

}

function hideDequeue() {
    document.getElementById("dequeue-container").style.display = "none";
}
function showDequeue() {
    document.getElementById("dequeue-container").style.display = "block"
}

function dequeueAjax(uID) {
    $.ajax({
        url: "php/queue.php",
        method: "POST",
        data: {
            dequeue: uID
        },
        success: dequeueLineSitter
    });
}

function dequeueLineSitter(result) {
    console.log(result);
    showAlert(false, "Removed from queue");
    flipSubtitle();
    hideDequeue();
    showEnqueue();
    location.reload();
}
function initPage() {
    let text_input = document.getElementsByClassName("form-control");
    for (let i in text_input) {
        text_input[i].oninput = function () {
            if (this.classList.contains("is-invalid")) {
                this.classList.remove("is-invalid");
            }
        };
    }
}
