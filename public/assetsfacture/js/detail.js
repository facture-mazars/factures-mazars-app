$(function () {

    'use strict';

    /**
     * Generating PDF from HTML using jQuery
     */
    $(document).on('click', '#invoice_download_table', function () {
        var $div = $("#table"); // Sélectionner la div que vous voulez capturer
        var contentWidth = $div.outerWidth();
        var contentHeight = $div.outerHeight();
        var topLeftMargin = 20;
        var pdfWidth = contentWidth + (topLeftMargin * 2);
        var pdfHeight = (pdfWidth * 1.5) + (topLeftMargin * 2);
        var canvasImageWidth = contentWidth;
        var canvasImageHeight = contentHeight;
        var totalPDFPages = Math.ceil(contentHeight / pdfHeight) - 1;

     
       // Utiliser les variables globales injectées dans window
       var nomClient = window.nomClient;
       var mission = window.mission;

       var nomPdf = "Rapport_" + nomClient + "_" + mission+".pdf";


        html2canvas($("#table")[0], {allowTaint: true}).then(function (canvas) {
            canvas.getContext('2d');
            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = new jsPDF('p', 'pt', [pdfWidth, pdfHeight]);
            pdf.addImage(imgData, 'JPG', topLeftMargin, topLeftMargin, canvasImageWidth, canvasImageHeight);
            for (var i = 1; i <= totalPDFPages; i++) {
                pdf.addPage(pdfWidth, pdfHeight);
                pdf.addImage(imgData, 'JPG', topLeftMargin, -(pdfHeight * i) + (topLeftMargin * 4), canvasImageWidth, canvasImageHeight);
            }
            pdf.save(nomPdf);
        });
    });
})
