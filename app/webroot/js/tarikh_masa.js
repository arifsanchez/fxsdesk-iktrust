function int() {

    var d_names = new Array("Sunday", "Monday", "Tuesday",
        "Wednesday", "Thursday", "Friday", "Saturday");

    var m_names = new Array("January", "February", "March",
        "April", "May", "June", "July", "August", "September",
        "October", "November", "December");

    var d = new Date();
    
    // Set Tarikh    
    var curr_day = d.getDay();
    var curr_date = d.getDate();
    var curr_month = d.getMonth();
    var curr_year = d.getFullYear();
    var tarikh = d_names[curr_day] + ", " + curr_date + " " + m_names[curr_month] + " " + curr_year;

    //Set Masa
    var a_p = "";
    var curr_hour = d.getHours();
    if (curr_hour < 12) {
        a_p = "AM";
    } else {
        a_p = "PM";
    }
    if (curr_hour == 0) {
        curr_hour = 12;
    }
    if (curr_hour > 12) {
        curr_hour = curr_hour - 12;
    }

    var curr_min = d.getMinutes();

    curr_min = curr_min + "";

    if (curr_min.length == 1) {
        curr_min = "0" + curr_min;
    }
    
    var curr_sec = d.getSeconds();
    
    curr_sec = curr_sec + "";

    if (curr_sec.length == 1) {
        curr_sec = "0" + curr_sec;
    }
    
    var masa = curr_hour + ":" + curr_min + ":" + curr_sec + " " +a_p;

    $("#tarikh").text(tarikh);
    $("#masa").text(masa);
}
setInterval(int, 1);