$("label").addClass('hide-label');
$("#contact-form form").attr("novalidate", "");

const test = ["^[a-zA-Z-]{3,16}$", "^[a-zA-Z-]{3,16}$", "^([a-zA-Z0-9_\.\+-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$", "[A-Za-z0-9\W]{4,80}", "[A-Za-z0-9\W]+"];

const regexTest = (value, test) => {
    let regex = new RegExp (test);
    return regex.test(value);
}

$("#contact-form button").on("click", (e) => {
    e.preventDefault();
    let valid = 0;
    $("#contact-form input").each((i, element) => {
        let val = $(element).val();
        
        if (!regexTest(val, test[i])){
            $("label").eq(i).removeClass('hide-label').css("color", "red");
            $(element).css("border", "2px solid red").css("color", "red");
            console.log(`Form input ${i} failed Regex.`);
        } else {
            console.log('Data validated.');
            $("label").eq(i).addClass('hide-label');
            valid++;
        }
        $(element).on('input', () => {
            $(element).attr("style", "none");
        });
    });
    
    if (valid === 4) {
        console.log("All imputs valid. Process form.");
    } else {
        console.log(`${valid}/4 inputs valid.`);
    }
})