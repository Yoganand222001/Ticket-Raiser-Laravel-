<x-mail::message>
# Ticket Raised

please assign any one of the agents for this ticket

<x-mail::button :url="$ticket_url">
View Ticket
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
