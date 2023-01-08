<x-mail::message>
# Hello {{$name}}

The body of your message.

<x-mail::Panel>
Panel
</x-mail::Panel>

<x-mail::button :url="''">
View Text
</x-mail::button>

<x-mail::table>
    | Laravel       | Table         | Example  |
    | ------------- |:-------------:| --------:|
    | Col 2 is      | Centered      |       |
    | Col 3 is      | Right-Aligned |       |
</x-mail::table>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

