<!doctype html>
<html>
<head>
    <title>Examples</title>
</head>
<body>
<p>Rendering the list using the for loop</p>
<button onclick="test()">sssssssssss</button>
<div id="result"></div>
<script>

    let arr = []
    let di =''
    function printArray(){
        document.getElementById("result").innerHTML = di
    }
    printArray()
    function test(){
        let data = {
            "name":"",
            "quantity":1
        };
        let idx = arr.push(data);
        di += `<div class="container">
                <select id="products" name="products">
                    <option value="volvo${idx}">Volvo</option>
                    <option value="saab${idx}">Saab</option>
                    <option value="fiat${idx}">Fiat</option>
                    <option value="audi${idx}">Audi</option>
                </select>
               <input type="number" id="qty${idx}" name="tentacles${idx}" />
               </div>`
        printArray();
    }
</script>
</body>
</html>