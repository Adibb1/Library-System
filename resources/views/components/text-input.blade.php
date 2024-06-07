@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 bg-[#CB997E] text-black focus:border-black focus:bg-[#DDBEA9] focus:ring-black rounded-md shadow-sm']) !!}>

<style>
    /* Style for autofilled input */
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus {
        background-color: #CB997E !important;
        -webkit-box-shadow: 0 0 0px 1000px #CB997E inset !important;
    }
</style>