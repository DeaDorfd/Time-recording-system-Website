function idset(id, string) {
    document.getElementById(id).innerHTML = string;
  }
  
  var stoppuhr = (function() {
    var stop = 1;
    var days = 0;
    var hrs = 0;
    var mins = 0;
    var secs = 0;
    var msecs = 0;
    return {
      start: function() {
        stop = 0;
      },
      stop: function() {
        stop = 1;
      },
      clear: function() {
        stoppuhr.stop();
        days = 0;
        hrs = 0;
        mins = 0;
        secs = 0;
        stoppuhr.html();
      },
      restart: function() {
        stoppuhr.clear();
        stoppuhr.start();
      },
      timer: function() {
        if (stop === 0) {
          msecs++;
          if (msecs === 100) {
            secs ++;
            msecs = 0;
          }
          if (secs === 60) {
            mins++;
            secs = 0;
          }
          if (mins === 60) {
            hrs++;
            mins = 0;
          }
          if (hrs === 24) {
            days++;
            hrs = 0;
          }
          stoppuhr.html();
        }
      },
      set: function(tage, stunden, minuten, sekunden) {
        stoppuhr.stop();
        days = tage;
        hrs = stunden;
        mins = minuten;
        secs = sekunden;
        stoppuhr.html();
      },
      html: function() {
        idset("tage", days);
        idset("stunden", hrs);
        idset("minuten", mins);
        idset("sekunden", secs);
      }
    }
  })();
  setInterval(stoppuhr.timer, 10);


  function erfassung(nr) {
    if(nr === 1) {
        document.getElementById("Dauer").style.display = "none";
        document.getElementById("stoppuhr").style.display = "none";
        document.getElementById("Zeitraum").style.display = "block";
        document.getElementById("zeit").className = "nav-link active";
        document.getElementById("uhr").className = "nav-link";
        document.getElementById("time").className = "nav-link";
    }
    if(nr === 2) {
        document.getElementById("Zeitraum").style.display = "none";
        document.getElementById("stoppuhr").style.display = "none";
        document.getElementById("Dauer").style.display = "block";
        document.getElementById("zeit").className = "nav-link";
        document.getElementById("time").className = "nav-link active";
        document.getElementById("uhr").className = "nav-link";
    }
    if(nr === 3) {
        document.getElementById("Zeitraum").style.display = "none";
        document.getElementById("Dauer").style.display = "none";
        document.getElementById("stoppuhr").style.display = "block";
        document.getElementById("zeit").className = "nav-link";
        document.getElementById("time").className = "nav-link";
        document.getElementById("uhr").className = "nav-link active";
    }
}

function timeChange() {
  
  var von = document.getElementById("von");
  var bis = document.getElementById("bis");

  var vonstunde = von.value.split(":")[0];
  var bisstunde = bis.value.split(":")[0];

  var vonminute = von.value.split(":")[1];
  var bisminute = bis.value.split(":")[1];

  var stundedifference = bisstunde - vonstunde;
  var minutedifference = bisminute - vonminute;

  if (minutedifference < 0) {
    minutedifference += 60;
    stundedifference--;
  }



  if (stundedifference < 0) {
    stundedifference += 24;
  }

  document.getElementById("erfassenbutton").innerHTML = stundedifference + "h " + minutedifference + "m";

}

timeChange();

function dauerChange() {
  var dauer = document.getElementById("dauer");
  var dauerstunde = dauer.value.split(":")[0];
  var dauerminute = dauer.value.split(":")[1];
  document.getElementById("dauerbutton").innerHTML = dauerstunde + "h " + dauerminute + "m";
}

dauerChange();