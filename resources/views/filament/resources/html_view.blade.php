<x-filament-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText() ?? null"
    :hint="$getHint() ?? null"
    :hint-icon="$getHintIcon() ?? null"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div class="w-full">
        <iframe
            class="w-full h-[75vh] border-0"
            srcdoc="{{ $getState() }}"
        ></iframe>
    </div>
</x-filament-forms::field-wrapper>
