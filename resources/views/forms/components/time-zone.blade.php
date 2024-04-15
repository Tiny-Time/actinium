<div x-data="{ stateTimeZone: $wire.$entangle('{{ $getStatePath() }}') }" x-init="stateTimeZone = (() => {
    const offset = new Date().getTimezoneOffset() / 60;
    const sign = offset < 0 ? '+' : '-';
    const absOffset = Math.abs(offset);

    const userTimeZone = `UTC${sign}${absOffset}`;

    return userTimeZone;
})()">
    <input type="text" name="timezone" x-model="stateTimeZone" class="hidden" id="timezone">
</div>
