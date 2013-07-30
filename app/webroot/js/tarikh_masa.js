

    function masa(){
        var date = moment().format("dddd, MMMM Do, YYYY");
        var time = moment().format("h:MM:ss A");

        $('#tarikh').text(date);
        
        $('#masa').text(time);

        
    }

    setInterval(masa, 2);


