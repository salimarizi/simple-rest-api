<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title><![CDATA[ Web Semantik ]]></title>
        <link><![CDATA[ http://www.praktikum.com/maranatha ]]></link>
        <description><![CDATA[ Praktikum Web Semantik ]]></description>
        <language>en</language>
        <pubDate>{{ now() }}</pubDate>
        @foreach($students as $student)
            <item>
                <title><![CDATA[{{ $student->nama }}]]></title>
                <link>{{ url('/').'/students/'.$student->nrp }}</link>
                <prodi>{{ $student->prodi }}</prodi>
                <fakultas>{{ $student->fakultas }}</fakultas>
                <universitas>{{ $student->universitas }}</universitas>
                <guid>{{ $student->id }}</guid>
                <pubDate>{{ $student->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>
