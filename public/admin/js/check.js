function multycheck() {
    var showdata = new Array();
    var n = jQuery("#checkItem:checked").length;
    if (n > 0){
        jQuery("#checkItem:checked").each(function(){
            showdata.push($(this).val());
        });
    }

      document.getElementById('span').innerText=showdata.length;
       var val=showdata;
if (val>0){

}
        $('input[name=id]').val(val);

}
$(document).ready(function () {
    $('body').persianNum();
});

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "حفظ";
    } else {
        document.getElementById("nextBtn").innerHTML = "التالى";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false
            valid = false;
        }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
}

// $('.mytable').DataTable({
//     "language": {
//         "sEmptyTable":     "ليست هناك بيانات متاحة في الجدول",
//         "sLoadingRecords": "جارٍ التحميل...",
//         "sProcessing":   "جارٍ التحميل...",
//         "sLengthMenu":   "أظهر _MENU_ مدخلات",
//         "sZeroRecords":  "لم يعثر على أية سجلات",
//         "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
//         "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",
//         "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
//         "sInfoPostFix":  "",
//         "sSearch":       "ابحث:",
//         "sUrl":          "",
//         "oPaginate": {
//             "sFirst":    "الأول",
//             "sPrevious": "السابق",
//             "sNext":     "التالي",
//             "sLast":     "الأخير"
//         },
//         "oAria": {
//             "sSortAscending":  ": تفعيل لترتيب العمود تصاعدياً",
//             "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
//         }
//     }
// });
