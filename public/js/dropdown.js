document.getElementById("FileAttachment").onchange = function () {
    document.getElementById("fileuploadurl").value = this.value.replace(/C:\\fakepath\\/i, '');
};


