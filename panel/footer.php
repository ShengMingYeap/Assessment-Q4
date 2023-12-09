</div>
</div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-minicolors/2.3.6/jquery.minicolors.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.colorpicker').minicolors({
                animationSpeed: 50,
                animationEasing:'swing',
                changeDelay: 0,
                control:'hue',
                defaultValue:'0069ff',
                format:'hex',
                showSpeed: 100,
                hideSpeed: 100,
                inline:false,
                keywords:'',
                letterCase:'lowercase',
                opacity:false,
                position:'bottom left',
                theme:'default'
            });

            $('#datatables').DataTable();
        });
    </script>
    </body>
</html>