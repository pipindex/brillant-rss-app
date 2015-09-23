<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }

            .attachment-large {
                display: block;
                margin: auto;
                max-width: 100%;
                margin: 1em 0 1em 0;
            }

            .date,
            .description a {
                text-decoration: none;
                color: #333;
            }

            a {
                text-decoration: none;
            }

            .content {
                font-size: 0.75em;
            }

        </style>
    </head>
    <body>
        <div class="container">
            <div class="content" style="max-width: 800px; margin: auto;">
                <h1>Brilliant RSS APP</h1>
                <hr>
                @foreach ($articles as $article)
                    <div @if ($article != end($articles)) style="padding-bottom: 16px; margin-bottom: 1em; border-bottom: 1px solid #333;" @endif>
                    <div style="text-align: left; max-width: 80%; margin: auto;">
                        <a href="<?= $article['link'] ?>">
                            <h1>{{ $article['title'] }}</h1>
                            <h2> By {{ $article['author'] }} </h2>

                            <?php 
                            $publishedDateInEpoch = strtotime($article['date']);
                            $hoursSinceEpoch = \Carbon\Carbon::createFromTimeStamp($publishedDateInEpoch)->diffForHumans(); 
                            ?>

                            <div style="float:right; font-weight: bold; color: navy; margin-bottom: 10px; font-size:18px;" class="date">{{ $hoursSinceEpoch }}</div>
                            <div class="description">
                                <?= $article['description'] ?>
                            </div>
                        <a>
                    </div>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>
