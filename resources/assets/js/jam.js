//Jam Online
(function ($, window, document) {
    if ($('.rt-clock').length > 0) {
        var monthNames = ['Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'];
        var dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'];

        var newDate = new Date();

        newDate.setDate(newDate.getDate());

        var date = dayNames[newDate.getDay()] + ', ' + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear();

        $('.rt-clock .date').html(date);

        setInterval(
            function () {
                var seconds = new Date().getSeconds();
                $(".rt-clock .seconds").html((seconds < 10 ? "0" : "") + seconds);
            }, 1000);

        setInterval(
            function () {
                var minutes = new Date().getMinutes();
                $(".rt-clock .minutes").html((minutes < 10 ? "0" : "") + minutes);
            }, 1000);

        setInterval(
            function () {
                var hours = new Date().getHours();
                $(".rt-clock .hours").html((hours < 10 ? "0" : "") + hours);
            }, 1000);
    }
}(jQuery, window, document));