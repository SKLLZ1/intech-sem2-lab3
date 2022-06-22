window.onload = () => {
    const group = document.getElementById("group");

    group.addEventListener("submit", function (event) {
        event.preventDefault();

        const thisGroup = new FormData(this);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "University.php");
        xhr.responseType = 'text';
        xhr.send(thisGroup);

        xhr.onload = () => {
            document.getElementById("content").innerHTML = xhr.responseText;
        }
    })

    const teacher = document.getElementById("teacher");

    teacher.addEventListener("submit", function (event) {
        event.preventDefault();

        const thisTeacher = new FormData(this);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "University.php");
        xhr.responseType = 'json';
        xhr.send(thisTeacher);

        xhr.onload = () => {
            document.getElementById("content").innerHTML = xhr.response;
        }
    })

    const auditorium = document.getElementById("auditorium");

    auditorium.addEventListener("submit", function (event) {
        event.preventDefault();

        const thisAuditorium = new FormData(this);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "University.php");
        xhr.responseType = 'document';
        xhr.send(thisAuditorium);

        xhr.onload = () => {
            let txt = "<table><tr><th> Week Day</th><th>Lesson Number</th><th>Auditorium</th><th>Disciple</th><th>Type</th></tr>";
            let rows = xhr.responseXML.firstChild.children;
            for (let i = 0; i < rows.length; i++) {
                txt += "<tr>"+
                    "<td>" + rows[i].children[0].firstChild.nodeValue + "</td>" +
                    "<td>" + rows[i].children[1].firstChild.nodeValue + "</td>" +
                    "<td>" + rows[i].children[2].firstChild.nodeValue + "</td>" +
                    "<td>" + rows[i].children[3].firstChild.nodeValue + "</td>" +
                    "<td>" + rows[i].children[4].firstChild.nodeValue + "</td></tr>>";
            }
            txt += "</table>";
            document.getElementById("content").innerHTML = txt;
        }
    })
}


