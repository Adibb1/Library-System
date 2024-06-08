@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-[#FFE8D6] border-b-black bg-[#FFE8D6] text-black focus:border-black focus:bg-[#DDBEA9] focus:ring-black rounded-md shadow-sm']) !!}>

<style>
    /* Style for autofilled input */
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus {
        background-color: #DDBEA9 !important;
        -webkit-box-shadow: 0 0 0px 1000px #DDBEA9 inset !important;
    }
</style>