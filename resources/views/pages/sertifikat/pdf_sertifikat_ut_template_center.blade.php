<!DOCTYPE html>
<html>

<head>
    <style type="text/css">


        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
            z-index: -1;
            overflow: hidden;
            page-break-after: always;
        }


        page[size="A4"][layout="landscape"] {
            width: 29.7cm;
            height: 21cm;
        }

        @media print {
            body, page {
                width: 29.7cm;
                height: 21cm;
                background: white;
                display: block;
                margin: 0 auto;
                margin-bottom: 0cm;
                box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
            }
        }

        div.page {
            page-break-inside: avoid;
            page-break-after: auto
        }

        .nama {
            position: fixed;
            @if(!empty($xy_nama))
                        top: {{$xy_nama.'px'}};
            @endif
                            text-align: center;
            width: 50%;
            font-family: "Times New Roman", Times, serif;
            font-size: 20pt;
            @if(!empty($color))
                     color: {{$color}};
        @endif






        }

        .sebagai {
            position: fixed;
            @if(!empty($xy_sebagai))
              top: {{$xy_sebagai.'px'}};
            @endif
              text-align: center;
            width: 50%;
            font-family: "Times New Roman", Times, serif;
            font-size: 20pt;
            @if(!empty($color))
                            color: {{$color}};

        @endif

        }

        .nim {
            position: fixed;
            top :25px;
            margin-left: 270mm;
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            font-weight: bold;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="page">
    <page size="A4" layout="landscape">

        <div>

            @if(!empty($nama_file_1))
                <p><img style="height: 100%; width: 100%; object-fit: contain;" src="{{public_path('/storage/template_seminar/' . $nama_file_1)}}"/>
            @endif
            @if(!empty($nama_file_2))
                <p><img style="height: 100%; width: 100%; object-fit: contain;" src="{{public_path('/storage/template_seminar/' . $nama_file_2)}}"/>
            @endif

                @if(!empty($nama))

                    <table style="border-collapse: collapse; width: 100%;" border="0" class="nim">
                        <tbody>
                        <tr>
                            <td style="width: 100%;">{{$nim}}</td>
                        </tr>
                        </tbody>
                    </table>
                @endif
            @if(!empty($nama))

                <table style="border-collapse: collapse; width: 100%;" border="0" class="nama">
                    <tbody>
                    <tr>
                        <td style="width: 100%; text-align: center;">{{$nama}}</td>
                    </tr>
                    </tbody>
                </table>
            @endif
            @if(!empty($sebagai))
                <table style="border-collapse: collapse; width: 100%;" border="0" class="sebagai">
                    <tbody>
                    <tr>
                        <td style="width: 100%; text-align: center;">{{$sebagai}}</td>
                    </tr>
                    </tbody>
                </table>
            @endif
        </div>
    </page>
</div>
</body>
</html>
