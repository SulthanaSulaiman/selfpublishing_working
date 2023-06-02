function Show_cfrontText(value) {
    if (value == 1) { document.getElementById('cfrontText').style.display = 'block'; }
    else { document.getElementById('cfrontText').style.display = 'none'; }
    return;
}
function Show_spineText(value) {
    if (value == 1) { document.getElementById('spineText').style.display = 'block'; }
    else { document.getElementById('spineText').style.display = 'none'; }
    return;
}
function Show_cbackText(value) {
    if (value == 1) { document.getElementById('cbackText').style.display = 'block'; }
    else { document.getElementById('cbackText').style.display = 'none'; }
    return;
}

function show_coverId(value) {

    if (value != null) {
        document.getElementById('coverImageId').value =" "+ value;
        document.getElementById('coverImageId').style.display = 'inline';
    }

    else {
        document.getElementById('coverImageId').style.display = 'none';
    }
    return value;

}
   // Defining a function to display error message
   function printError(elemId, hintMsg) {
    try{
        document.getElementById(elemId).innerHTML = hintMsg;
    }
    catch(err)
    {
        console.log(err);
    }
} 

function validateForm() {
    try{
 // Retrieving the values of form elements 
    var paperWeight = document.authorForm.paperWeight.value;
    var coverType = document.authorForm.coverType.value;
    var priceBarcode = document.authorForm.priceBarcode.value;
    var trimSize = document.authorForm.trimSize.value;
    var dimenSpecification = document.authorForm.dimenSpecification.value;
    var services = [];
    var checkboxes = document.getElementsByName("services[]");
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            // Populate hobbies array with selected values
            services.push(checkboxes[i].value);
        }
    }
    

    var artImage = document.authorForm.artImage.value;
    var authorImage = document.authorForm.authorImage.value;

    var visionDesign = document.authorForm.visionDesign.value;
    var file=document.getElementById("fileUpload").value;

    // Defining error variables with a default value
    var paperWeightErr = coverTypeErr = priceBarcodeErr = trimSizeErr = dimenSpecificationErr = servicesErr = artImageErr = authorImageErr = visionDesignErr=fileErr= true;

    // Validate paperWeight
    if (paperWeight == "") {
        printError("paperWeightErr", "Please enter paper weight.");
    } else {

        printError("paperWeightErr", "");
        paperWeightErr = false;
    }

    // Validate coverType
    if (coverType == "Choose...") {
        printError("coverTypeErr", "Please select cover type.");
    } else {
        printError("coverTypeErr", "");
        coverTypeErr = false;
    }

    // Validate priceBarcode
    if (priceBarcode == "") {
        printError("priceBarcodeErr", "Please enter price to barcode.");
    } else {

        printError("priceBarcodeErr", "");
        priceBarcodeErr = false;
    }

    // Validate trimSize
    if (trimSize == "") {
        printError("trimSizeErr", "Please select trim size.");
    } else {
        printError("trimSizeErr", "");
        trimSizeErr = false;
    }

    // Validate dimenSpecification
    if (dimenSpecification == "") {
        printError("dimenSpecificationErr", "Please select Yes or No.");
    } else {
        printError("dimenSpecificationErr", "");
        dimenSpecificationErr = false;
    }

    // Validate services
    if (services.length == 0) {
        printError("servicesErr", "Please choose any one service.");
    } else {
        printError("servicesErr", "");
        servicesErr = false;
    }
    // Validate authorImage
    if (authorImage == "") {
        printError("authorImageErr", "Please select Yes or No.");
    } else {
        printError("authorImageErr", "");
        authorImageErr = false;
    }

    // Validate artImage
    if (artImage == "") {
        printError("artImageErr", "Please select Yes or No.");
    } else {
        printError("artImageErr", "");
        artImageErr = false;
    }

     //Validate vision Design
    if (visionDesign == "") {
        printError("visionDesignErr", "Please enter vision to your design.");
    } else {
        printError("visionDesignErr", "");
        visionDesignErr = false;
    }
    // Validate manuscript file
    if (file == "") {
        printError("fileErr", "Please select the menuscript file(s).");
    } else {

        printError("fileErr", "");
        fileErr = false;
    }
   
 if ((paperWeightErr || coverTypeErr || priceBarcodeErr || trimSizeErr || dimenSpecificationErr || servicesErr||artImageErr || authorImageErr || visionDesignErr||fileErr) == true) {
    console.log("paperWeightErr:"+paperWeightErr);
    console.log("coverTypeErr:"+coverTypeErr);
    console.log("priceBarcodeErr:"+priceBarcodeErr);
    console.log("trimSizeErr:"+trimSizeErr);
    console.log("dimenSpecificationErr:"+dimenSpecificationErr);
    console.log("servicesErr:"+servicesErr);
    console.log("artImageErr:"+artImageErr);
    console.log("authorImageErr:"+authorImageErr);
    console.log("visionDesignErr:"+visionDesignErr);
    console.log("fileErr:"+fileErr);
    

    return false;
    }
    else {
        console.log("paperWeightErr:"+paperWeightErr);
        console.log("coverTypeErr:"+coverTypeErr);
        console.log("priceBarcodeErr:"+priceBarcodeErr);
        console.log("trimSizeErr:"+trimSizeErr);
        console.log("dimenSpecificationErr:"+dimenSpecificationErr);
        console.log("servicesErr:"+servicesErr);
        console.log("artImageErr:"+artImageErr);
        console.log("authorImageErr:"+authorImageErr);
        console.log("visionDesignErr:"+visionDesignErr);
        console.log("fileErr:"+fileErr);
        
        return true;
    }
    }catch(err)
    {
        console.log(err);
    }
   
};

/*Files upload*/
window.addEventListener("load", () => {
    const input = document.getElementById("fileUpload");
    // const filewrapper=document.getElementById("filewrapper");

    input.addEventListener("change", (e) => {
        let fileLength = e.target.files.length;
        //let filetype=e.target.value.split(".").pop();
        console.log(fileLength);
        fileshow(fileLength);
    })

    const fileshow = (fileLength) => {
        if (fileLength == 1) {
            document.getElementById("noOfFiles").innerHTML = fileLength + " file selected";
        }
        else {
            document.getElementById("noOfFiles").innerHTML = fileLength + " files selected";
        }

        // console.log(showfileboxElem);
        //  filewrapper.append(showfileboxElem);
    }
})