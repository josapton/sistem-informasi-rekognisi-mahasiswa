<title>Rekognisi Mahasiswa | {{ $title }}</title>
<h1 align="center">{{ $title }}</h1>
<h3 align="center">Tanggal: {{ $date }} | Jam: {{ $jam }}</h3>
<hr>
<table width="100%" cellspacing="0" cellpadding="5" border="1">
    <thead>
        <tr>
            <th width="5%" align="center" style="font-weight: bold; font-family: 'Times New Roman', Times, serif; font-size: 12;">
                No
            </th>
            <th width="20%" align="center" style="font-weight: bold; font-family: 'Times New Roman', Times, serif; font-size: 12;">
                Username
            </th>
            <th width="30%" align="center" style="font-weight: bold; font-family: 'Times New Roman', Times, serif; font-size: 12;">
                Nama
            </th>
            <th width="25%" align="center" style="font-weight: bold; font-family: 'Times New Roman', Times, serif; font-size: 12;">
                Email
            </th>
            <th width="20%" align="center" style="font-weight: bold; font-family: 'Times New Roman', Times, serif; font-size: 12;">
                Role
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td align="center" style="font-family: 'Times New Roman', Times, serif; font-size: 12;">
                {{ $loop->iteration }}
            </td>
            <td style="font-family: 'Times New Roman', Times, serif; font-size: 12;">
                {{ $user->username }}
            </td>
            <td style="font-family: 'Times New Roman', Times, serif; font-size: 12;">
                {{ $user->nama }}
            </td>
            <td style="font-family: 'Times New Roman', Times, serif; font-size: 12;">
                <a href="mailto:{{ $user->email }}">
                    {{ $user->email }}
                </a>
            </td>
            <td align="center" style="font-family: 'Times New Roman', Times, serif; font-size: 12;">
                {{ $user->role }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>