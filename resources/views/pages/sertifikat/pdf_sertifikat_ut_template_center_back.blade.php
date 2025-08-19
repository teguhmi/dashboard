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


        }
    </style>
</head>
<body>
<div class="page">
    <page size="A4" layout="landscape">
        <div>
            {{--            @if(!empty($backdrop))--}}
            <p><img style="height: 100%; width: 100%; object-fit: contain;" src="{{secure_url('/storage/template_seminar/' . $nama_file_2)}}"/>
            {{--            @endif--}}
        </div>
    </page>
</div>
</body>
</html>
