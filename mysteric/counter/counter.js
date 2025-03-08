if(ctoken !== ""){
	fetch("counter/token.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: `ctoken=${ctoken}`
    })
}