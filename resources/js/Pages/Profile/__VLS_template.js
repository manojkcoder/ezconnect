import AuthenticatedUserLayout from '@/Layouts/AuthenticatedUserLayout.vue';
import { Head } from '@inertiajs/vue3';
import draggable from 'vuedraggable';
import TextInput from '@/Components/TextInput.vue';
import { __VLS_internalComponent, __VLS_componentsOption, __VLS_name, saveForm, formData, profilePicture, uploadPhoto, logo, formErrors, bannerPicture, getError, updateNetwork, networks, addNetwork, removeNetwork } from './Edit.vue';

function __VLS_template() {
let __VLS_ctx!: InstanceType<__VLS_PickNotAny<typeof __VLS_internalComponent, new () => {}>> & {};
/* Components */
let __VLS_otherComponents!: NonNullable<typeof __VLS_internalComponent extends { components: infer C; } ? C : {}> & typeof __VLS_componentsOption;
let __VLS_own!: __VLS_SelfComponent<typeof __VLS_name, typeof __VLS_internalComponent & (new () => { $slots: typeof __VLS_slots; })>;
let __VLS_localComponents!: typeof __VLS_otherComponents & Omit<typeof __VLS_own, keyof typeof __VLS_otherComponents>;
let __VLS_components!: typeof __VLS_localComponents & __VLS_GlobalComponents & typeof __VLS_ctx;
/* Style Scoped */
type __VLS_StyleScopedClasses = {};
let __VLS_styleScopedClasses!: __VLS_StyleScopedClasses | keyof __VLS_StyleScopedClasses | (keyof __VLS_StyleScopedClasses)[];
/* CSS variable injection */
/* CSS variable injection end */
let __VLS_resolvedLocalAndGlobalComponents!: {} &
__VLS_WithComponent<'Head', typeof __VLS_localComponents, "Head", "Head", "Head"> &
__VLS_WithComponent<'AuthenticatedUserLayout', typeof __VLS_localComponents, "AuthenticatedUserLayout", "AuthenticatedUserLayout", "AuthenticatedUserLayout"> &
__VLS_WithComponent<'TextInput', typeof __VLS_localComponents, "TextInput", "TextInput", "TextInput"> &
__VLS_WithComponent<'draggable', typeof __VLS_localComponents, "Draggable", "draggable", "draggable">;
__VLS_components.Head;
// @ts-ignore
[Head,];
__VLS_components.AuthenticatedUserLayout; __VLS_components.AuthenticatedUserLayout;
// @ts-ignore
[AuthenticatedUserLayout, AuthenticatedUserLayout,];
__VLS_intrinsicElements.main; __VLS_intrinsicElements.main;
__VLS_intrinsicElements.h1; __VLS_intrinsicElements.h1;
__VLS_intrinsicElements.section; __VLS_intrinsicElements.section;
__VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div;
__VLS_intrinsicElements.form; __VLS_intrinsicElements.form;
__VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span;
__VLS_intrinsicElements.img; __VLS_intrinsicElements.img; __VLS_intrinsicElements.img; __VLS_intrinsicElements.img;
__VLS_intrinsicElements.label; __VLS_intrinsicElements.label; __VLS_intrinsicElements.label; __VLS_intrinsicElements.label; __VLS_intrinsicElements.label; __VLS_intrinsicElements.label;
__VLS_intrinsicElements.h4; __VLS_intrinsicElements.h4; __VLS_intrinsicElements.h4; __VLS_intrinsicElements.h4; __VLS_intrinsicElements.h4; __VLS_intrinsicElements.h4;
__VLS_intrinsicElements.p; __VLS_intrinsicElements.p; __VLS_intrinsicElements.p; __VLS_intrinsicElements.p; __VLS_intrinsicElements.p; __VLS_intrinsicElements.p;
__VLS_intrinsicElements.input; __VLS_intrinsicElements.input; __VLS_intrinsicElements.input; __VLS_intrinsicElements.input;
__VLS_components.TextInput; __VLS_components.TextInput; __VLS_components.TextInput; __VLS_components.TextInput; __VLS_components.TextInput; __VLS_components.TextInput; __VLS_components.TextInput; __VLS_components.TextInput;
// @ts-ignore
[TextInput, TextInput, TextInput, TextInput, TextInput, TextInput, TextInput, TextInput,];
__VLS_intrinsicElements.h3; __VLS_intrinsicElements.h3; __VLS_intrinsicElements.h3; __VLS_intrinsicElements.h3;
__VLS_components.Draggable; __VLS_components.Draggable; __VLS_components.draggable; __VLS_components.draggable;
// @ts-ignore
[draggable, draggable,];
__VLS_intrinsicElements.template; __VLS_intrinsicElements.template;
__VLS_intrinsicElements.select; __VLS_intrinsicElements.select;
__VLS_intrinsicElements.option; __VLS_intrinsicElements.option;
__VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button;
__VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i;
__VLS_intrinsicElements.a; __VLS_intrinsicElements.a; __VLS_intrinsicElements.a; __VLS_intrinsicElements.a; __VLS_intrinsicElements.a; __VLS_intrinsicElements.a; __VLS_intrinsicElements.a; __VLS_intrinsicElements.a; __VLS_intrinsicElements.a; __VLS_intrinsicElements.a; __VLS_intrinsicElements.a; __VLS_intrinsicElements.a; __VLS_intrinsicElements.a; __VLS_intrinsicElements.a;
__VLS_intrinsicElements.ul; __VLS_intrinsicElements.ul;
__VLS_intrinsicElements.li; __VLS_intrinsicElements.li; __VLS_intrinsicElements.li; __VLS_intrinsicElements.li;
{
const __VLS_0 = ({} as 'Head' extends keyof typeof __VLS_ctx ? { 'Head': typeof __VLS_ctx.Head; } : typeof __VLS_resolvedLocalAndGlobalComponents).Head;
const __VLS_1 = __VLS_asFunctionalComponent(__VLS_0, new __VLS_0({ ...{}, title: ("Profile"), }));
({} as { Head: typeof __VLS_0; }).Head;
const __VLS_2 = __VLS_1({ ...{}, title: ("Profile"), }, ...__VLS_functionalComponentArgsRest(__VLS_1));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_0, typeof __VLS_2> & Record<string, unknown>) => void)({ ...{}, title: ("Profile"), });
const __VLS_3 = __VLS_pickFunctionalComponentCtx(__VLS_0, __VLS_2)!;
let __VLS_4!: __VLS_NormalizeEmits<typeof __VLS_3.emit>;
}
{
const __VLS_5 = ({} as 'AuthenticatedUserLayout' extends keyof typeof __VLS_ctx ? { 'AuthenticatedUserLayout': typeof __VLS_ctx.AuthenticatedUserLayout; } : typeof __VLS_resolvedLocalAndGlobalComponents).AuthenticatedUserLayout;
const __VLS_6 = __VLS_asFunctionalComponent(__VLS_5, new __VLS_5({ ...{}, }));
({} as { AuthenticatedUserLayout: typeof __VLS_5; }).AuthenticatedUserLayout;
({} as { AuthenticatedUserLayout: typeof __VLS_5; }).AuthenticatedUserLayout;
const __VLS_7 = __VLS_6({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_6));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_5, typeof __VLS_7> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_8 = __VLS_pickFunctionalComponentCtx(__VLS_5, __VLS_7)!;
let __VLS_9!: __VLS_NormalizeEmits<typeof __VLS_8.emit>;
{
const __VLS_10 = __VLS_intrinsicElements["main"];
const __VLS_11 = __VLS_elementAsFunctionalComponent(__VLS_10);
const __VLS_12 = __VLS_11({ ...{}, class: ("content"), }, ...__VLS_functionalComponentArgsRest(__VLS_11));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_10, typeof __VLS_12> & Record<string, unknown>) => void)({ ...{}, class: ("content"), });
const __VLS_13 = __VLS_pickFunctionalComponentCtx(__VLS_10, __VLS_12)!;
let __VLS_14!: __VLS_NormalizeEmits<typeof __VLS_13.emit>;
{
const __VLS_15 = __VLS_intrinsicElements["h1"];
const __VLS_16 = __VLS_elementAsFunctionalComponent(__VLS_15);
const __VLS_17 = __VLS_16({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_16));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_15, typeof __VLS_17> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_18 = __VLS_pickFunctionalComponentCtx(__VLS_15, __VLS_17)!;
let __VLS_19!: __VLS_NormalizeEmits<typeof __VLS_18.emit>;
(__VLS_18.slots!).default;
}
{
const __VLS_20 = __VLS_intrinsicElements["section"];
const __VLS_21 = __VLS_elementAsFunctionalComponent(__VLS_20);
const __VLS_22 = __VLS_21({ ...{}, class: ("profileSection section"), }, ...__VLS_functionalComponentArgsRest(__VLS_21));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_20, typeof __VLS_22> & Record<string, unknown>) => void)({ ...{}, class: ("profileSection section"), });
const __VLS_23 = __VLS_pickFunctionalComponentCtx(__VLS_20, __VLS_22)!;
let __VLS_24!: __VLS_NormalizeEmits<typeof __VLS_23.emit>;
{
const __VLS_25 = __VLS_intrinsicElements["div"];
const __VLS_26 = __VLS_elementAsFunctionalComponent(__VLS_25);
const __VLS_27 = __VLS_26({ ...{}, class: ("container"), }, ...__VLS_functionalComponentArgsRest(__VLS_26));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_25, typeof __VLS_27> & Record<string, unknown>) => void)({ ...{}, class: ("container"), });
const __VLS_28 = __VLS_pickFunctionalComponentCtx(__VLS_25, __VLS_27)!;
let __VLS_29!: __VLS_NormalizeEmits<typeof __VLS_28.emit>;
{
const __VLS_30 = __VLS_intrinsicElements["form"];
const __VLS_31 = __VLS_elementAsFunctionalComponent(__VLS_30);
const __VLS_32 = __VLS_31({ ...{ onSubmit: {} as any, }, class: ("section-main"), }, ...__VLS_functionalComponentArgsRest(__VLS_31));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_30, typeof __VLS_32> & Record<string, unknown>) => void)({ ...{ onSubmit: {} as any, }, class: ("section-main"), });
const __VLS_33 = __VLS_pickFunctionalComponentCtx(__VLS_30, __VLS_32)!;
let __VLS_34!: __VLS_NormalizeEmits<typeof __VLS_33.emit>;
let __VLS_35 = { 'submit': __VLS_pickEvent(__VLS_34['submit'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_31, typeof __VLS_32>).onSubmit) };
__VLS_35 = { submit: (__VLS_ctx.saveForm) };
{
const __VLS_36 = __VLS_intrinsicElements["div"];
const __VLS_37 = __VLS_elementAsFunctionalComponent(__VLS_36);
const __VLS_38 = __VLS_37({ ...{}, class: ("profile-wrapper"), }, ...__VLS_functionalComponentArgsRest(__VLS_37));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_36, typeof __VLS_38> & Record<string, unknown>) => void)({ ...{}, class: ("profile-wrapper"), });
const __VLS_39 = __VLS_pickFunctionalComponentCtx(__VLS_36, __VLS_38)!;
let __VLS_40!: __VLS_NormalizeEmits<typeof __VLS_39.emit>;
{
const __VLS_41 = __VLS_intrinsicElements["div"];
const __VLS_42 = __VLS_elementAsFunctionalComponent(__VLS_41);
const __VLS_43 = __VLS_42({ ...{}, class: ("profile-picture"), }, ...__VLS_functionalComponentArgsRest(__VLS_42));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_41, typeof __VLS_43> & Record<string, unknown>) => void)({ ...{}, class: ("profile-picture"), });
const __VLS_44 = __VLS_pickFunctionalComponentCtx(__VLS_41, __VLS_43)!;
let __VLS_45!: __VLS_NormalizeEmits<typeof __VLS_44.emit>;
{
const __VLS_46 = __VLS_intrinsicElements["span"];
const __VLS_47 = __VLS_elementAsFunctionalComponent(__VLS_46);
const __VLS_48 = __VLS_47({ ...{}, class: ("img-wrapper"), }, ...__VLS_functionalComponentArgsRest(__VLS_47));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_46, typeof __VLS_48> & Record<string, unknown>) => void)({ ...{}, class: ("img-wrapper"), });
const __VLS_49 = __VLS_pickFunctionalComponentCtx(__VLS_46, __VLS_48)!;
let __VLS_50!: __VLS_NormalizeEmits<typeof __VLS_49.emit>;
if (__VLS_ctx.formData.profile_picture) {
{
const __VLS_51 = __VLS_intrinsicElements["img"];
const __VLS_52 = __VLS_elementAsFunctionalComponent(__VLS_51);
const __VLS_53 = __VLS_52({ ...{}, src: ((__VLS_ctx.formData.profile_picture)), alt: ("Jane cooper"), }, ...__VLS_functionalComponentArgsRest(__VLS_52));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_51, typeof __VLS_53> & Record<string, unknown>) => void)({ ...{}, src: ((__VLS_ctx.formData.profile_picture)), alt: ("Jane cooper"), });
const __VLS_54 = __VLS_pickFunctionalComponentCtx(__VLS_51, __VLS_53)!;
let __VLS_55!: __VLS_NormalizeEmits<typeof __VLS_54.emit>;
}
// @ts-ignore
[saveForm, formData, formData, formData,];
}
(__VLS_49.slots!).default;
}
{
const __VLS_56 = __VLS_intrinsicElements["span"];
const __VLS_57 = __VLS_elementAsFunctionalComponent(__VLS_56);
const __VLS_58 = __VLS_57({ ...{}, class: ("upload-field"), }, ...__VLS_functionalComponentArgsRest(__VLS_57));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_56, typeof __VLS_58> & Record<string, unknown>) => void)({ ...{}, class: ("upload-field"), });
const __VLS_59 = __VLS_pickFunctionalComponentCtx(__VLS_56, __VLS_58)!;
let __VLS_60!: __VLS_NormalizeEmits<typeof __VLS_59.emit>;
{
const __VLS_61 = __VLS_intrinsicElements["label"];
const __VLS_62 = __VLS_elementAsFunctionalComponent(__VLS_61);
const __VLS_63 = __VLS_62({ ...{}, class: ("upload-field-label"), }, ...__VLS_functionalComponentArgsRest(__VLS_62));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_61, typeof __VLS_63> & Record<string, unknown>) => void)({ ...{}, class: ("upload-field-label"), });
const __VLS_64 = __VLS_pickFunctionalComponentCtx(__VLS_61, __VLS_63)!;
let __VLS_65!: __VLS_NormalizeEmits<typeof __VLS_64.emit>;
{
const __VLS_66 = __VLS_intrinsicElements["h4"];
const __VLS_67 = __VLS_elementAsFunctionalComponent(__VLS_66);
const __VLS_68 = __VLS_67({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_67));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_66, typeof __VLS_68> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_69 = __VLS_pickFunctionalComponentCtx(__VLS_66, __VLS_68)!;
let __VLS_70!: __VLS_NormalizeEmits<typeof __VLS_69.emit>;
(__VLS_69.slots!).default;
}
{
const __VLS_71 = __VLS_intrinsicElements["p"];
const __VLS_72 = __VLS_elementAsFunctionalComponent(__VLS_71);
const __VLS_73 = __VLS_72({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_72));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_71, typeof __VLS_73> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_74 = __VLS_pickFunctionalComponentCtx(__VLS_71, __VLS_73)!;
let __VLS_75!: __VLS_NormalizeEmits<typeof __VLS_74.emit>;
(__VLS_74.slots!).default;
}
{
const __VLS_76 = __VLS_intrinsicElements["span"];
const __VLS_77 = __VLS_elementAsFunctionalComponent(__VLS_76);
const __VLS_78 = __VLS_77({ ...{}, class: ("site-btn dark-btn"), }, ...__VLS_functionalComponentArgsRest(__VLS_77));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_76, typeof __VLS_78> & Record<string, unknown>) => void)({ ...{}, class: ("site-btn dark-btn"), });
const __VLS_79 = __VLS_pickFunctionalComponentCtx(__VLS_76, __VLS_78)!;
let __VLS_80!: __VLS_NormalizeEmits<typeof __VLS_79.emit>;
(__VLS_79.slots!).default;
}
(__VLS_64.slots!).default;
}
{
const __VLS_81 = __VLS_intrinsicElements["input"];
const __VLS_82 = __VLS_elementAsFunctionalComponent(__VLS_81);
const __VLS_83 = __VLS_82({ ...{ onChange: {} as any, }, type: ("file"), id: ("profile-picture"), ref: ("profilePicture"), }, ...__VLS_functionalComponentArgsRest(__VLS_82));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_81, typeof __VLS_83> & Record<string, unknown>) => void)({ ...{ onChange: {} as any, }, type: ("file"), id: ("profile-picture"), ref: ("profilePicture"), });
const __VLS_84 = __VLS_pickFunctionalComponentCtx(__VLS_81, __VLS_83)!;
let __VLS_85!: __VLS_NormalizeEmits<typeof __VLS_84.emit>;
// @ts-ignore
(__VLS_ctx.profilePicture);
let __VLS_86 = { 'change': __VLS_pickEvent(__VLS_85['change'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_82, typeof __VLS_83>).onChange) };
__VLS_86 = {
change: $event => {
__VLS_ctx.uploadPhoto('profilePicture');
// @ts-ignore
[profilePicture, uploadPhoto,];
}
};
}
(__VLS_59.slots!).default;
}
(__VLS_44.slots!).default;
}
{
const __VLS_87 = __VLS_intrinsicElements["div"];
const __VLS_88 = __VLS_elementAsFunctionalComponent(__VLS_87);
const __VLS_89 = __VLS_88({ ...{}, class: ("profile-logo"), }, ...__VLS_functionalComponentArgsRest(__VLS_88));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_87, typeof __VLS_89> & Record<string, unknown>) => void)({ ...{}, class: ("profile-logo"), });
const __VLS_90 = __VLS_pickFunctionalComponentCtx(__VLS_87, __VLS_89)!;
let __VLS_91!: __VLS_NormalizeEmits<typeof __VLS_90.emit>;
{
const __VLS_92 = __VLS_intrinsicElements["span"];
const __VLS_93 = __VLS_elementAsFunctionalComponent(__VLS_92);
const __VLS_94 = __VLS_93({ ...{}, class: ("img-wrapper"), }, ...__VLS_functionalComponentArgsRest(__VLS_93));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_92, typeof __VLS_94> & Record<string, unknown>) => void)({ ...{}, class: ("img-wrapper"), });
const __VLS_95 = __VLS_pickFunctionalComponentCtx(__VLS_92, __VLS_94)!;
let __VLS_96!: __VLS_NormalizeEmits<typeof __VLS_95.emit>;
{
const __VLS_97 = __VLS_intrinsicElements["img"];
const __VLS_98 = __VLS_elementAsFunctionalComponent(__VLS_97);
const __VLS_99 = __VLS_98({ ...{}, src: ((__VLS_ctx.formData.logo)), alt: ("FinovateFall"), }, ...__VLS_functionalComponentArgsRest(__VLS_98));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_97, typeof __VLS_99> & Record<string, unknown>) => void)({ ...{}, src: ((__VLS_ctx.formData.logo)), alt: ("FinovateFall"), });
const __VLS_100 = __VLS_pickFunctionalComponentCtx(__VLS_97, __VLS_99)!;
let __VLS_101!: __VLS_NormalizeEmits<typeof __VLS_100.emit>;
}
(__VLS_95.slots!).default;
}
{
const __VLS_102 = __VLS_intrinsicElements["span"];
const __VLS_103 = __VLS_elementAsFunctionalComponent(__VLS_102);
const __VLS_104 = __VLS_103({ ...{}, class: ("upload-field"), }, ...__VLS_functionalComponentArgsRest(__VLS_103));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_102, typeof __VLS_104> & Record<string, unknown>) => void)({ ...{}, class: ("upload-field"), });
const __VLS_105 = __VLS_pickFunctionalComponentCtx(__VLS_102, __VLS_104)!;
let __VLS_106!: __VLS_NormalizeEmits<typeof __VLS_105.emit>;
{
const __VLS_107 = __VLS_intrinsicElements["label"];
const __VLS_108 = __VLS_elementAsFunctionalComponent(__VLS_107);
const __VLS_109 = __VLS_108({ ...{}, class: ("upload-field-label"), }, ...__VLS_functionalComponentArgsRest(__VLS_108));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_107, typeof __VLS_109> & Record<string, unknown>) => void)({ ...{}, class: ("upload-field-label"), });
const __VLS_110 = __VLS_pickFunctionalComponentCtx(__VLS_107, __VLS_109)!;
let __VLS_111!: __VLS_NormalizeEmits<typeof __VLS_110.emit>;
{
const __VLS_112 = __VLS_intrinsicElements["h4"];
const __VLS_113 = __VLS_elementAsFunctionalComponent(__VLS_112);
const __VLS_114 = __VLS_113({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_113));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_112, typeof __VLS_114> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_115 = __VLS_pickFunctionalComponentCtx(__VLS_112, __VLS_114)!;
let __VLS_116!: __VLS_NormalizeEmits<typeof __VLS_115.emit>;
(__VLS_115.slots!).default;
}
{
const __VLS_117 = __VLS_intrinsicElements["span"];
const __VLS_118 = __VLS_elementAsFunctionalComponent(__VLS_117);
const __VLS_119 = __VLS_118({ ...{}, class: ("site-btn dark-btn"), }, ...__VLS_functionalComponentArgsRest(__VLS_118));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_117, typeof __VLS_119> & Record<string, unknown>) => void)({ ...{}, class: ("site-btn dark-btn"), });
const __VLS_120 = __VLS_pickFunctionalComponentCtx(__VLS_117, __VLS_119)!;
let __VLS_121!: __VLS_NormalizeEmits<typeof __VLS_120.emit>;
(__VLS_120.slots!).default;
}
(__VLS_110.slots!).default;
}
{
const __VLS_122 = __VLS_intrinsicElements["input"];
const __VLS_123 = __VLS_elementAsFunctionalComponent(__VLS_122);
const __VLS_124 = __VLS_123({ ...{ onChange: {} as any, }, type: ("file"), id: ("company-logo"), ref: ("logo"), }, ...__VLS_functionalComponentArgsRest(__VLS_123));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_122, typeof __VLS_124> & Record<string, unknown>) => void)({ ...{ onChange: {} as any, }, type: ("file"), id: ("company-logo"), ref: ("logo"), });
const __VLS_125 = __VLS_pickFunctionalComponentCtx(__VLS_122, __VLS_124)!;
let __VLS_126!: __VLS_NormalizeEmits<typeof __VLS_125.emit>;
// @ts-ignore
(__VLS_ctx.logo);
let __VLS_127 = { 'change': __VLS_pickEvent(__VLS_126['change'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_123, typeof __VLS_124>).onChange) };
__VLS_127 = {
change: $event => {
__VLS_ctx.uploadPhoto('logo');
// @ts-ignore
[formData, formData, logo, uploadPhoto,];
}
};
}
(__VLS_105.slots!).default;
}
(__VLS_90.slots!).default;
}
(__VLS_39.slots!).default;
}
{
const __VLS_128 = __VLS_intrinsicElements["div"];
const __VLS_129 = __VLS_elementAsFunctionalComponent(__VLS_128);
const __VLS_130 = __VLS_129({ ...{}, class: ("form-wrapper"), }, ...__VLS_functionalComponentArgsRest(__VLS_129));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_128, typeof __VLS_130> & Record<string, unknown>) => void)({ ...{}, class: ("form-wrapper"), });
const __VLS_131 = __VLS_pickFunctionalComponentCtx(__VLS_128, __VLS_130)!;
let __VLS_132!: __VLS_NormalizeEmits<typeof __VLS_131.emit>;
{
const __VLS_133 = __VLS_intrinsicElements["div"];
const __VLS_134 = __VLS_elementAsFunctionalComponent(__VLS_133);
const __VLS_135 = __VLS_134({ ...{}, class: ("container"), }, ...__VLS_functionalComponentArgsRest(__VLS_134));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_133, typeof __VLS_135> & Record<string, unknown>) => void)({ ...{}, class: ("container"), });
const __VLS_136 = __VLS_pickFunctionalComponentCtx(__VLS_133, __VLS_135)!;
let __VLS_137!: __VLS_NormalizeEmits<typeof __VLS_136.emit>;
{
const __VLS_138 = ({} as 'TextInput' extends keyof typeof __VLS_ctx ? { 'TextInput': typeof __VLS_ctx.TextInput; } : typeof __VLS_resolvedLocalAndGlobalComponents).TextInput;
const __VLS_139 = __VLS_asFunctionalComponent(__VLS_138, new __VLS_138({ ...{}, label: ("Name"), type: (('text')), name: ("name"), modelValue: ((__VLS_ctx.formData.name)), error: ((__VLS_ctx.formErrors.name?.pop())), required: (true), }));
({} as { TextInput: typeof __VLS_138; }).TextInput;
const __VLS_140 = __VLS_139({ ...{}, label: ("Name"), type: (('text')), name: ("name"), modelValue: ((__VLS_ctx.formData.name)), error: ((__VLS_ctx.formErrors.name?.pop())), required: (true), }, ...__VLS_functionalComponentArgsRest(__VLS_139));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_138, typeof __VLS_140> & Record<string, unknown>) => void)({ ...{}, label: ("Name"), type: (('text')), name: ("name"), modelValue: ((__VLS_ctx.formData.name)), error: ((__VLS_ctx.formErrors.name?.pop())), required: (true), });
const __VLS_141 = __VLS_pickFunctionalComponentCtx(__VLS_138, __VLS_140)!;
let __VLS_142!: __VLS_NormalizeEmits<typeof __VLS_141.emit>;
}
{
const __VLS_143 = ({} as 'TextInput' extends keyof typeof __VLS_ctx ? { 'TextInput': typeof __VLS_ctx.TextInput; } : typeof __VLS_resolvedLocalAndGlobalComponents).TextInput;
const __VLS_144 = __VLS_asFunctionalComponent(__VLS_143, new __VLS_143({ ...{}, label: ("Username"), type: (('text')), name: ("username"), modelValue: ((__VLS_ctx.formData.username)), error: ((__VLS_ctx.formErrors.username?.pop())), required: (true), }));
({} as { TextInput: typeof __VLS_143; }).TextInput;
const __VLS_145 = __VLS_144({ ...{}, label: ("Username"), type: (('text')), name: ("username"), modelValue: ((__VLS_ctx.formData.username)), error: ((__VLS_ctx.formErrors.username?.pop())), required: (true), }, ...__VLS_functionalComponentArgsRest(__VLS_144));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_143, typeof __VLS_145> & Record<string, unknown>) => void)({ ...{}, label: ("Username"), type: (('text')), name: ("username"), modelValue: ((__VLS_ctx.formData.username)), error: ((__VLS_ctx.formErrors.username?.pop())), required: (true), });
const __VLS_146 = __VLS_pickFunctionalComponentCtx(__VLS_143, __VLS_145)!;
let __VLS_147!: __VLS_NormalizeEmits<typeof __VLS_146.emit>;
}
{
const __VLS_148 = ({} as 'TextInput' extends keyof typeof __VLS_ctx ? { 'TextInput': typeof __VLS_ctx.TextInput; } : typeof __VLS_resolvedLocalAndGlobalComponents).TextInput;
const __VLS_149 = __VLS_asFunctionalComponent(__VLS_148, new __VLS_148({ ...{}, label: ("Company Name"), type: (('text')), name: ("company_name"), modelValue: ((__VLS_ctx.formData.company_name)), error: ((__VLS_ctx.formErrors.company_name?.pop())), required: (true), }));
({} as { TextInput: typeof __VLS_148; }).TextInput;
const __VLS_150 = __VLS_149({ ...{}, label: ("Company Name"), type: (('text')), name: ("company_name"), modelValue: ((__VLS_ctx.formData.company_name)), error: ((__VLS_ctx.formErrors.company_name?.pop())), required: (true), }, ...__VLS_functionalComponentArgsRest(__VLS_149));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_148, typeof __VLS_150> & Record<string, unknown>) => void)({ ...{}, label: ("Company Name"), type: (('text')), name: ("company_name"), modelValue: ((__VLS_ctx.formData.company_name)), error: ((__VLS_ctx.formErrors.company_name?.pop())), required: (true), });
const __VLS_151 = __VLS_pickFunctionalComponentCtx(__VLS_148, __VLS_150)!;
let __VLS_152!: __VLS_NormalizeEmits<typeof __VLS_151.emit>;
}
{
const __VLS_153 = ({} as 'TextInput' extends keyof typeof __VLS_ctx ? { 'TextInput': typeof __VLS_ctx.TextInput; } : typeof __VLS_resolvedLocalAndGlobalComponents).TextInput;
const __VLS_154 = __VLS_asFunctionalComponent(__VLS_153, new __VLS_153({ ...{}, label: ("Title"), type: (('text')), name: ("title"), modelValue: ((__VLS_ctx.formData.title)), error: ((__VLS_ctx.formErrors.title?.pop())), required: (true), }));
({} as { TextInput: typeof __VLS_153; }).TextInput;
const __VLS_155 = __VLS_154({ ...{}, label: ("Title"), type: (('text')), name: ("title"), modelValue: ((__VLS_ctx.formData.title)), error: ((__VLS_ctx.formErrors.title?.pop())), required: (true), }, ...__VLS_functionalComponentArgsRest(__VLS_154));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_153, typeof __VLS_155> & Record<string, unknown>) => void)({ ...{}, label: ("Title"), type: (('text')), name: ("title"), modelValue: ((__VLS_ctx.formData.title)), error: ((__VLS_ctx.formErrors.title?.pop())), required: (true), });
const __VLS_156 = __VLS_pickFunctionalComponentCtx(__VLS_153, __VLS_155)!;
let __VLS_157!: __VLS_NormalizeEmits<typeof __VLS_156.emit>;
}
{
const __VLS_158 = __VLS_intrinsicElements["div"];
const __VLS_159 = __VLS_elementAsFunctionalComponent(__VLS_158);
const __VLS_160 = __VLS_159({ ...{}, class: ("field"), }, ...__VLS_functionalComponentArgsRest(__VLS_159));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_158, typeof __VLS_160> & Record<string, unknown>) => void)({ ...{}, class: ("field"), });
const __VLS_161 = __VLS_pickFunctionalComponentCtx(__VLS_158, __VLS_160)!;
let __VLS_162!: __VLS_NormalizeEmits<typeof __VLS_161.emit>;
{
const __VLS_163 = __VLS_intrinsicElements["label"];
const __VLS_164 = __VLS_elementAsFunctionalComponent(__VLS_163);
const __VLS_165 = __VLS_164({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_164));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_163, typeof __VLS_165> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_166 = __VLS_pickFunctionalComponentCtx(__VLS_163, __VLS_165)!;
let __VLS_167!: __VLS_NormalizeEmits<typeof __VLS_166.emit>;
(__VLS_166.slots!).default;
}
{
const __VLS_168 = __VLS_intrinsicElements["div"];
const __VLS_169 = __VLS_elementAsFunctionalComponent(__VLS_168);
const __VLS_170 = __VLS_169({ ...{}, class: ("banner-upload-field"), }, ...__VLS_functionalComponentArgsRest(__VLS_169));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_168, typeof __VLS_170> & Record<string, unknown>) => void)({ ...{}, class: ("banner-upload-field"), });
const __VLS_171 = __VLS_pickFunctionalComponentCtx(__VLS_168, __VLS_170)!;
let __VLS_172!: __VLS_NormalizeEmits<typeof __VLS_171.emit>;
{
const __VLS_173 = __VLS_intrinsicElements["input"];
const __VLS_174 = __VLS_elementAsFunctionalComponent(__VLS_173);
const __VLS_175 = __VLS_174({ ...{ onChange: {} as any, }, type: ("file"), class: ("form-control"), ref: ("bannerPicture"), }, ...__VLS_functionalComponentArgsRest(__VLS_174));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_173, typeof __VLS_175> & Record<string, unknown>) => void)({ ...{ onChange: {} as any, }, type: ("file"), class: ("form-control"), ref: ("bannerPicture"), });
const __VLS_176 = __VLS_pickFunctionalComponentCtx(__VLS_173, __VLS_175)!;
let __VLS_177!: __VLS_NormalizeEmits<typeof __VLS_176.emit>;
// @ts-ignore
(__VLS_ctx.bannerPicture);
let __VLS_178 = { 'change': __VLS_pickEvent(__VLS_177['change'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_174, typeof __VLS_175>).onChange) };
__VLS_178 = {
change: $event => {
__VLS_ctx.uploadPhoto('bannerPicture');
// @ts-ignore
[formData, formErrors, formData, formErrors, formData, formErrors, formData, formErrors, formData, formErrors, formData, formErrors, formData, formErrors, formData, formErrors, formData, formErrors, formData, formErrors, formData, formErrors, formData, formErrors, bannerPicture, uploadPhoto,];
}
};
}
{
const __VLS_179 = __VLS_intrinsicElements["span"];
const __VLS_180 = __VLS_elementAsFunctionalComponent(__VLS_179);
const __VLS_181 = __VLS_180({ ...{}, class: ("banner-upload-label"), }, ...__VLS_functionalComponentArgsRest(__VLS_180));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_179, typeof __VLS_181> & Record<string, unknown>) => void)({ ...{}, class: ("banner-upload-label"), });
const __VLS_182 = __VLS_pickFunctionalComponentCtx(__VLS_179, __VLS_181)!;
let __VLS_183!: __VLS_NormalizeEmits<typeof __VLS_182.emit>;
{
const __VLS_184 = __VLS_intrinsicElements["span"];
const __VLS_185 = __VLS_elementAsFunctionalComponent(__VLS_184);
const __VLS_186 = __VLS_185({ ...{}, class: ("site-btn dark-btn"), }, ...__VLS_functionalComponentArgsRest(__VLS_185));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_184, typeof __VLS_186> & Record<string, unknown>) => void)({ ...{}, class: ("site-btn dark-btn"), });
const __VLS_187 = __VLS_pickFunctionalComponentCtx(__VLS_184, __VLS_186)!;
let __VLS_188!: __VLS_NormalizeEmits<typeof __VLS_187.emit>;
(__VLS_187.slots!).default;
}
{
const __VLS_189 = __VLS_intrinsicElements["span"];
const __VLS_190 = __VLS_elementAsFunctionalComponent(__VLS_189);
const __VLS_191 = __VLS_190({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_190));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_189, typeof __VLS_191> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_192 = __VLS_pickFunctionalComponentCtx(__VLS_189, __VLS_191)!;
let __VLS_193!: __VLS_NormalizeEmits<typeof __VLS_192.emit>;
(__VLS_192.slots!).default;
}
(__VLS_182.slots!).default;
}
(__VLS_171.slots!).default;
}
(__VLS_161.slots!).default;
}
{
const __VLS_194 = ({} as 'TextInput' extends keyof typeof __VLS_ctx ? { 'TextInput': typeof __VLS_ctx.TextInput; } : typeof __VLS_resolvedLocalAndGlobalComponents).TextInput;
const __VLS_195 = __VLS_asFunctionalComponent(__VLS_194, new __VLS_194({ ...{}, label: ("Email"), type: (('text')), name: ("email"), modelValue: ((__VLS_ctx.formData.email)), error: ((__VLS_ctx.formErrors.email?.pop())), required: (true), }));
({} as { TextInput: typeof __VLS_194; }).TextInput;
const __VLS_196 = __VLS_195({ ...{}, label: ("Email"), type: (('text')), name: ("email"), modelValue: ((__VLS_ctx.formData.email)), error: ((__VLS_ctx.formErrors.email?.pop())), required: (true), }, ...__VLS_functionalComponentArgsRest(__VLS_195));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_194, typeof __VLS_196> & Record<string, unknown>) => void)({ ...{}, label: ("Email"), type: (('text')), name: ("email"), modelValue: ((__VLS_ctx.formData.email)), error: ((__VLS_ctx.formErrors.email?.pop())), required: (true), });
const __VLS_197 = __VLS_pickFunctionalComponentCtx(__VLS_194, __VLS_196)!;
let __VLS_198!: __VLS_NormalizeEmits<typeof __VLS_197.emit>;
}
{
const __VLS_199 = ({} as 'TextInput' extends keyof typeof __VLS_ctx ? { 'TextInput': typeof __VLS_ctx.TextInput; } : typeof __VLS_resolvedLocalAndGlobalComponents).TextInput;
const __VLS_200 = __VLS_asFunctionalComponent(__VLS_199, new __VLS_199({ ...{}, class: (('full-row')), placeholder: (('Max 500 characters')), label: ("Bio"), type: ("textarea"), name: ("bio"), modelValue: ((__VLS_ctx.formData.bio)), error: ((__VLS_ctx.formErrors.bio?.pop())), required: (true), }));
({} as { TextInput: typeof __VLS_199; }).TextInput;
const __VLS_201 = __VLS_200({ ...{}, class: (('full-row')), placeholder: (('Max 500 characters')), label: ("Bio"), type: ("textarea"), name: ("bio"), modelValue: ((__VLS_ctx.formData.bio)), error: ((__VLS_ctx.formErrors.bio?.pop())), required: (true), }, ...__VLS_functionalComponentArgsRest(__VLS_200));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_199, typeof __VLS_201> & Record<string, unknown>) => void)({ ...{}, class: (('full-row')), placeholder: (('Max 500 characters')), label: ("Bio"), type: ("textarea"), name: ("bio"), modelValue: ((__VLS_ctx.formData.bio)), error: ((__VLS_ctx.formErrors.bio?.pop())), required: (true), });
const __VLS_202 = __VLS_pickFunctionalComponentCtx(__VLS_199, __VLS_201)!;
let __VLS_203!: __VLS_NormalizeEmits<typeof __VLS_202.emit>;
}
(__VLS_136.slots!).default;
}
(__VLS_131.slots!).default;
}
{
const __VLS_204 = __VLS_intrinsicElements["div"];
const __VLS_205 = __VLS_elementAsFunctionalComponent(__VLS_204);
const __VLS_206 = __VLS_205({ ...{}, class: ("social-media-section"), }, ...__VLS_functionalComponentArgsRest(__VLS_205));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_204, typeof __VLS_206> & Record<string, unknown>) => void)({ ...{}, class: ("social-media-section"), });
const __VLS_207 = __VLS_pickFunctionalComponentCtx(__VLS_204, __VLS_206)!;
let __VLS_208!: __VLS_NormalizeEmits<typeof __VLS_207.emit>;
{
const __VLS_209 = __VLS_intrinsicElements["div"];
const __VLS_210 = __VLS_elementAsFunctionalComponent(__VLS_209);
const __VLS_211 = __VLS_210({ ...{}, class: ("container"), }, ...__VLS_functionalComponentArgsRest(__VLS_210));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_209, typeof __VLS_211> & Record<string, unknown>) => void)({ ...{}, class: ("container"), });
const __VLS_212 = __VLS_pickFunctionalComponentCtx(__VLS_209, __VLS_211)!;
let __VLS_213!: __VLS_NormalizeEmits<typeof __VLS_212.emit>;
{
const __VLS_214 = __VLS_intrinsicElements["h3"];
const __VLS_215 = __VLS_elementAsFunctionalComponent(__VLS_214);
const __VLS_216 = __VLS_215({ ...{}, class: ("full-row mb-0"), }, ...__VLS_functionalComponentArgsRest(__VLS_215));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_214, typeof __VLS_216> & Record<string, unknown>) => void)({ ...{}, class: ("full-row mb-0"), });
const __VLS_217 = __VLS_pickFunctionalComponentCtx(__VLS_214, __VLS_216)!;
let __VLS_218!: __VLS_NormalizeEmits<typeof __VLS_217.emit>;
(__VLS_217.slots!).default;
}
{
const __VLS_219 = ({} as 'Draggable' extends keyof typeof __VLS_ctx ? { 'draggable': typeof __VLS_ctx.Draggable; } : 'draggable' extends keyof typeof __VLS_ctx ? { 'draggable': typeof __VLS_ctx.draggable; } : typeof __VLS_resolvedLocalAndGlobalComponents).draggable;
const __VLS_220 = __VLS_asFunctionalComponent(__VLS_219, new __VLS_219({ ...{}, modelValue: ((__VLS_ctx.formData.networks)), itemKey: ("index"), }));
({} as { draggable: typeof __VLS_219; }).draggable;
({} as { draggable: typeof __VLS_219; }).draggable;
const __VLS_221 = __VLS_220({ ...{}, modelValue: ((__VLS_ctx.formData.networks)), itemKey: ("index"), }, ...__VLS_functionalComponentArgsRest(__VLS_220));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_219, typeof __VLS_221> & Record<string, unknown>) => void)({ ...{}, modelValue: ((__VLS_ctx.formData.networks)), itemKey: ("index"), });
const __VLS_222 = __VLS_pickFunctionalComponentCtx(__VLS_219, __VLS_221)!;
let __VLS_223!: __VLS_NormalizeEmits<typeof __VLS_222.emit>;
{
const __VLS_224 = __VLS_intrinsicElements["template"];
const __VLS_225 = __VLS_elementAsFunctionalComponent(__VLS_224);
const __VLS_226 = __VLS_225({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_225));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_224, typeof __VLS_226> & Record<string, unknown>) => void)({ ...{}, });
{
const [{ element, index }] = __VLS_getSlotParams((__VLS_222.slots!).item);
{
const __VLS_227 = __VLS_intrinsicElements["div"];
const __VLS_228 = __VLS_elementAsFunctionalComponent(__VLS_227);
const __VLS_229 = __VLS_228({ ...{}, class: ("social-media-row"), }, ...__VLS_functionalComponentArgsRest(__VLS_228));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_227, typeof __VLS_229> & Record<string, unknown>) => void)({ ...{}, class: ("social-media-row"), });
const __VLS_230 = __VLS_pickFunctionalComponentCtx(__VLS_227, __VLS_229)!;
let __VLS_231!: __VLS_NormalizeEmits<typeof __VLS_230.emit>;
{
const __VLS_232 = __VLS_intrinsicElements["div"];
const __VLS_233 = __VLS_elementAsFunctionalComponent(__VLS_232);
const __VLS_234 = __VLS_233({ ...{}, class: ("dragable-row"), draggable: ("true"), }, ...__VLS_functionalComponentArgsRest(__VLS_233));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_232, typeof __VLS_234> & Record<string, unknown>) => void)({ ...{}, class: ("dragable-row"), draggable: ("true"), });
const __VLS_235 = __VLS_pickFunctionalComponentCtx(__VLS_232, __VLS_234)!;
let __VLS_236!: __VLS_NormalizeEmits<typeof __VLS_235.emit>;
{
const __VLS_237 = __VLS_intrinsicElements["div"];
const __VLS_238 = __VLS_elementAsFunctionalComponent(__VLS_237);
const __VLS_239 = __VLS_238({ ...{}, class: ("select-field field"), }, ...__VLS_functionalComponentArgsRest(__VLS_238));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_237, typeof __VLS_239> & Record<string, unknown>) => void)({ ...{}, class: ("select-field field"), });
const __VLS_240 = __VLS_pickFunctionalComponentCtx(__VLS_237, __VLS_239)!;
let __VLS_241!: __VLS_NormalizeEmits<typeof __VLS_240.emit>;
{
const __VLS_242 = __VLS_intrinsicElements["select"];
const __VLS_243 = __VLS_elementAsFunctionalComponent(__VLS_242);
const __VLS_244 = __VLS_243({ ...{ onChange: {} as any, }, class: ("form-select"), }, ...__VLS_functionalComponentArgsRest(__VLS_243));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_242, typeof __VLS_244> & Record<string, unknown>) => void)({ ...{ onChange: {} as any, }, class: ("form-select"), });
const __VLS_245 = __VLS_pickFunctionalComponentCtx(__VLS_242, __VLS_244)!;
let __VLS_246!: __VLS_NormalizeEmits<typeof __VLS_245.emit>;
(__VLS_ctx.getError(index, 'social_network_id') ? 'error' : '');
let __VLS_247 = { 'change': __VLS_pickEvent(__VLS_246['change'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_243, typeof __VLS_244>).onChange) };
__VLS_247 = { change: (($event) => __VLS_ctx.updateNetwork($event, index)) };
for (const [network] of __VLS_getVForSourceType((__VLS_ctx.networks)!)) {
{
const __VLS_248 = __VLS_intrinsicElements["option"];
const __VLS_249 = __VLS_elementAsFunctionalComponent(__VLS_248);
const __VLS_250 = __VLS_249({ ...{}, value: ((network.key)), selected: ((network.id == element.social_network.id)), }, ...__VLS_functionalComponentArgsRest(__VLS_249));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_248, typeof __VLS_250> & Record<string, unknown>) => void)({ ...{}, value: ((network.key)), selected: ((network.id == element.social_network.id)), });
const __VLS_251 = __VLS_pickFunctionalComponentCtx(__VLS_248, __VLS_250)!;
let __VLS_252!: __VLS_NormalizeEmits<typeof __VLS_251.emit>;
(network.name);
(__VLS_251.slots!).default;
}
// @ts-ignore
[formData, formErrors, formData, formErrors, formData, formErrors, formData, formErrors, formData, formErrors, formData, formErrors, formData, formData, formData, getError, updateNetwork, networks,];
}
(__VLS_245.slots!).default;
}
{
const __VLS_253 = __VLS_intrinsicElements["p"];
const __VLS_254 = __VLS_elementAsFunctionalComponent(__VLS_253);
const __VLS_255 = __VLS_254({ ...{}, class: ("error-msg"), }, ...__VLS_functionalComponentArgsRest(__VLS_254));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_253, typeof __VLS_255> & Record<string, unknown>) => void)({ ...{}, class: ("error-msg"), });
const __VLS_256 = __VLS_pickFunctionalComponentCtx(__VLS_253, __VLS_255)!;
let __VLS_257!: __VLS_NormalizeEmits<typeof __VLS_256.emit>;
(__VLS_ctx.getError(index, 'social_network_id') ? 'This field is required' : '');
(__VLS_256.slots!).default;
}
(__VLS_240.slots!).default;
}
{
const __VLS_258 = __VLS_intrinsicElements["div"];
const __VLS_259 = __VLS_elementAsFunctionalComponent(__VLS_258);
const __VLS_260 = __VLS_259({ ...{}, class: ("social-media-icon"), }, ...__VLS_functionalComponentArgsRest(__VLS_259));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_258, typeof __VLS_260> & Record<string, unknown>) => void)({ ...{}, class: ("social-media-icon"), });
const __VLS_261 = __VLS_pickFunctionalComponentCtx(__VLS_258, __VLS_260)!;
let __VLS_262!: __VLS_NormalizeEmits<typeof __VLS_261.emit>;
{
const __VLS_263 = __VLS_intrinsicElements["span"];
const __VLS_264 = __VLS_elementAsFunctionalComponent(__VLS_263);
const __VLS_265 = __VLS_264({ ...{}, class: ("icon svg-icon"), }, ...__VLS_functionalComponentArgsRest(__VLS_264));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_263, typeof __VLS_265> & Record<string, unknown>) => void)({ ...{}, class: ("icon svg-icon"), });
const __VLS_266 = __VLS_pickFunctionalComponentCtx(__VLS_263, __VLS_265)!;
let __VLS_267!: __VLS_NormalizeEmits<typeof __VLS_266.emit>;
(element.social_network.icon);
}
(__VLS_261.slots!).default;
}
{
const __VLS_268 = ({} as 'TextInput' extends keyof typeof __VLS_ctx ? { 'TextInput': typeof __VLS_ctx.TextInput; } : typeof __VLS_resolvedLocalAndGlobalComponents).TextInput;
const __VLS_269 = __VLS_asFunctionalComponent(__VLS_268, new __VLS_268({ ...{}, placeholder: (('Enter the url here')), label: (""), type: (('text')), name: ("url"), modelValue: ((element.url)), error: ((__VLS_ctx.getError(index, 'url'))), required: (true), }));
({} as { TextInput: typeof __VLS_268; }).TextInput;
const __VLS_270 = __VLS_269({ ...{}, placeholder: (('Enter the url here')), label: (""), type: (('text')), name: ("url"), modelValue: ((element.url)), error: ((__VLS_ctx.getError(index, 'url'))), required: (true), }, ...__VLS_functionalComponentArgsRest(__VLS_269));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_268, typeof __VLS_270> & Record<string, unknown>) => void)({ ...{}, placeholder: (('Enter the url here')), label: (""), type: (('text')), name: ("url"), modelValue: ((element.url)), error: ((__VLS_ctx.getError(index, 'url'))), required: (true), });
const __VLS_271 = __VLS_pickFunctionalComponentCtx(__VLS_268, __VLS_270)!;
let __VLS_272!: __VLS_NormalizeEmits<typeof __VLS_271.emit>;
}
{
const __VLS_273 = ({} as 'TextInput' extends keyof typeof __VLS_ctx ? { 'TextInput': typeof __VLS_ctx.TextInput; } : typeof __VLS_resolvedLocalAndGlobalComponents).TextInput;
const __VLS_274 = __VLS_asFunctionalComponent(__VLS_273, new __VLS_273({ ...{}, placeholder: (('Enter the name here')), label: (""), type: (('text')), name: ("name"), modelValue: ((element.name)), error: ((__VLS_ctx.getError(index, 'name'))), required: (true), }));
({} as { TextInput: typeof __VLS_273; }).TextInput;
const __VLS_275 = __VLS_274({ ...{}, placeholder: (('Enter the name here')), label: (""), type: (('text')), name: ("name"), modelValue: ((element.name)), error: ((__VLS_ctx.getError(index, 'name'))), required: (true), }, ...__VLS_functionalComponentArgsRest(__VLS_274));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_273, typeof __VLS_275> & Record<string, unknown>) => void)({ ...{}, placeholder: (('Enter the name here')), label: (""), type: (('text')), name: ("name"), modelValue: ((element.name)), error: ((__VLS_ctx.getError(index, 'name'))), required: (true), });
const __VLS_276 = __VLS_pickFunctionalComponentCtx(__VLS_273, __VLS_275)!;
let __VLS_277!: __VLS_NormalizeEmits<typeof __VLS_276.emit>;
}
(__VLS_235.slots!).default;
}
{
const __VLS_278 = __VLS_intrinsicElements["div"];
const __VLS_279 = __VLS_elementAsFunctionalComponent(__VLS_278);
const __VLS_280 = __VLS_279({ ...{}, class: ("buttons-wrapper"), }, ...__VLS_functionalComponentArgsRest(__VLS_279));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_278, typeof __VLS_280> & Record<string, unknown>) => void)({ ...{}, class: ("buttons-wrapper"), });
const __VLS_281 = __VLS_pickFunctionalComponentCtx(__VLS_278, __VLS_280)!;
let __VLS_282!: __VLS_NormalizeEmits<typeof __VLS_281.emit>;
{
const __VLS_283 = __VLS_intrinsicElements["button"];
const __VLS_284 = __VLS_elementAsFunctionalComponent(__VLS_283);
const __VLS_285 = __VLS_284({ ...{}, type: ("button"), class: ("drag"), }, ...__VLS_functionalComponentArgsRest(__VLS_284));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_283, typeof __VLS_285> & Record<string, unknown>) => void)({ ...{}, type: ("button"), class: ("drag"), });
const __VLS_286 = __VLS_pickFunctionalComponentCtx(__VLS_283, __VLS_285)!;
let __VLS_287!: __VLS_NormalizeEmits<typeof __VLS_286.emit>;
{
const __VLS_288 = __VLS_intrinsicElements["i"];
const __VLS_289 = __VLS_elementAsFunctionalComponent(__VLS_288);
const __VLS_290 = __VLS_289({ ...{}, class: ("icon-dragable"), }, ...__VLS_functionalComponentArgsRest(__VLS_289));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_288, typeof __VLS_290> & Record<string, unknown>) => void)({ ...{}, class: ("icon-dragable"), });
const __VLS_291 = __VLS_pickFunctionalComponentCtx(__VLS_288, __VLS_290)!;
let __VLS_292!: __VLS_NormalizeEmits<typeof __VLS_291.emit>;
}
(__VLS_286.slots!).default;
}
{
const __VLS_293 = __VLS_intrinsicElements["button"];
const __VLS_294 = __VLS_elementAsFunctionalComponent(__VLS_293);
const __VLS_295 = __VLS_294({ ...{ onClick: {} as any, }, type: ("button"), class: ("add"), }, ...__VLS_functionalComponentArgsRest(__VLS_294));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_293, typeof __VLS_295> & Record<string, unknown>) => void)({ ...{ onClick: {} as any, }, type: ("button"), class: ("add"), });
const __VLS_296 = __VLS_pickFunctionalComponentCtx(__VLS_293, __VLS_295)!;
let __VLS_297!: __VLS_NormalizeEmits<typeof __VLS_296.emit>;
let __VLS_298 = { 'click': __VLS_pickEvent(__VLS_297['click'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_294, typeof __VLS_295>).onClick) };
__VLS_298 = {
click: $event => {
__VLS_ctx.addNetwork(index);
// @ts-ignore
[getError, getError, getError, getError, getError, getError, getError, addNetwork,];
}
};
{
const __VLS_299 = __VLS_intrinsicElements["i"];
const __VLS_300 = __VLS_elementAsFunctionalComponent(__VLS_299);
const __VLS_301 = __VLS_300({ ...{}, class: ("icon-add-icon"), }, ...__VLS_functionalComponentArgsRest(__VLS_300));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_299, typeof __VLS_301> & Record<string, unknown>) => void)({ ...{}, class: ("icon-add-icon"), });
const __VLS_302 = __VLS_pickFunctionalComponentCtx(__VLS_299, __VLS_301)!;
let __VLS_303!: __VLS_NormalizeEmits<typeof __VLS_302.emit>;
}
(__VLS_296.slots!).default;
}
{
const __VLS_304 = __VLS_intrinsicElements["button"];
const __VLS_305 = __VLS_elementAsFunctionalComponent(__VLS_304);
const __VLS_306 = __VLS_305({ ...{ onClick: {} as any, }, type: ("button"), class: ("delete"), }, ...__VLS_functionalComponentArgsRest(__VLS_305));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_304, typeof __VLS_306> & Record<string, unknown>) => void)({ ...{ onClick: {} as any, }, type: ("button"), class: ("delete"), });
const __VLS_307 = __VLS_pickFunctionalComponentCtx(__VLS_304, __VLS_306)!;
let __VLS_308!: __VLS_NormalizeEmits<typeof __VLS_307.emit>;
let __VLS_309 = { 'click': __VLS_pickEvent(__VLS_308['click'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_305, typeof __VLS_306>).onClick) };
__VLS_309 = {
click: $event => {
__VLS_ctx.removeNetwork(index);
// @ts-ignore
[removeNetwork,];
}
};
{
const __VLS_310 = __VLS_intrinsicElements["i"];
const __VLS_311 = __VLS_elementAsFunctionalComponent(__VLS_310);
const __VLS_312 = __VLS_311({ ...{}, class: ("icon-delete-icon"), }, ...__VLS_functionalComponentArgsRest(__VLS_311));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_310, typeof __VLS_312> & Record<string, unknown>) => void)({ ...{}, class: ("icon-delete-icon"), });
const __VLS_313 = __VLS_pickFunctionalComponentCtx(__VLS_310, __VLS_312)!;
let __VLS_314!: __VLS_NormalizeEmits<typeof __VLS_313.emit>;
}
(__VLS_307.slots!).default;
}
(__VLS_281.slots!).default;
}
(__VLS_230.slots!).default;
}
}
}
}
(__VLS_212.slots!).default;
}
(__VLS_207.slots!).default;
}
{
const __VLS_315 = __VLS_intrinsicElements["div"];
const __VLS_316 = __VLS_elementAsFunctionalComponent(__VLS_315);
const __VLS_317 = __VLS_316({ ...{}, class: ("form-submit"), }, ...__VLS_functionalComponentArgsRest(__VLS_316));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_315, typeof __VLS_317> & Record<string, unknown>) => void)({ ...{}, class: ("form-submit"), });
const __VLS_318 = __VLS_pickFunctionalComponentCtx(__VLS_315, __VLS_317)!;
let __VLS_319!: __VLS_NormalizeEmits<typeof __VLS_318.emit>;
{
const __VLS_320 = __VLS_intrinsicElements["button"];
const __VLS_321 = __VLS_elementAsFunctionalComponent(__VLS_320);
const __VLS_322 = __VLS_321({ ...{}, class: ("site-btn"), }, ...__VLS_functionalComponentArgsRest(__VLS_321));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_320, typeof __VLS_322> & Record<string, unknown>) => void)({ ...{}, class: ("site-btn"), });
const __VLS_323 = __VLS_pickFunctionalComponentCtx(__VLS_320, __VLS_322)!;
let __VLS_324!: __VLS_NormalizeEmits<typeof __VLS_323.emit>;
(__VLS_323.slots!).default;
}
{
const __VLS_325 = __VLS_intrinsicElements["input"];
const __VLS_326 = __VLS_elementAsFunctionalComponent(__VLS_325);
const __VLS_327 = __VLS_326({ ...{}, class: ("site-btn dark-btn submit"), type: ("submit"), Value: ("Save"), }, ...__VLS_functionalComponentArgsRest(__VLS_326));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_325, typeof __VLS_327> & Record<string, unknown>) => void)({ ...{}, class: ("site-btn dark-btn submit"), type: ("submit"), Value: ("Save"), });
const __VLS_328 = __VLS_pickFunctionalComponentCtx(__VLS_325, __VLS_327)!;
let __VLS_329!: __VLS_NormalizeEmits<typeof __VLS_328.emit>;
}
(__VLS_318.slots!).default;
}
(__VLS_33.slots!).default;
}
{
const __VLS_330 = __VLS_intrinsicElements["div"];
const __VLS_331 = __VLS_elementAsFunctionalComponent(__VLS_330);
const __VLS_332 = __VLS_331({ ...{}, class: ("sectionSideBar"), }, ...__VLS_functionalComponentArgsRest(__VLS_331));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_330, typeof __VLS_332> & Record<string, unknown>) => void)({ ...{}, class: ("sectionSideBar"), });
const __VLS_333 = __VLS_pickFunctionalComponentCtx(__VLS_330, __VLS_332)!;
let __VLS_334!: __VLS_NormalizeEmits<typeof __VLS_333.emit>;
{
const __VLS_335 = __VLS_intrinsicElements["div"];
const __VLS_336 = __VLS_elementAsFunctionalComponent(__VLS_335);
const __VLS_337 = __VLS_336({ ...{}, class: ("ss-inner"), }, ...__VLS_functionalComponentArgsRest(__VLS_336));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_335, typeof __VLS_337> & Record<string, unknown>) => void)({ ...{}, class: ("ss-inner"), });
const __VLS_338 = __VLS_pickFunctionalComponentCtx(__VLS_335, __VLS_337)!;
let __VLS_339!: __VLS_NormalizeEmits<typeof __VLS_338.emit>;
{
const __VLS_340 = __VLS_intrinsicElements["span"];
const __VLS_341 = __VLS_elementAsFunctionalComponent(__VLS_340);
const __VLS_342 = __VLS_341({ ...{}, class: ("company-logo"), }, ...__VLS_functionalComponentArgsRest(__VLS_341));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_340, typeof __VLS_342> & Record<string, unknown>) => void)({ ...{}, class: ("company-logo"), });
const __VLS_343 = __VLS_pickFunctionalComponentCtx(__VLS_340, __VLS_342)!;
let __VLS_344!: __VLS_NormalizeEmits<typeof __VLS_343.emit>;
if (__VLS_ctx.formData.logo) {
{
const __VLS_345 = __VLS_intrinsicElements["img"];
const __VLS_346 = __VLS_elementAsFunctionalComponent(__VLS_345);
const __VLS_347 = __VLS_346({ ...{}, src: ((__VLS_ctx.formData.logo)), alt: ((__VLS_ctx.formData.company_name)), }, ...__VLS_functionalComponentArgsRest(__VLS_346));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_345, typeof __VLS_347> & Record<string, unknown>) => void)({ ...{}, src: ((__VLS_ctx.formData.logo)), alt: ((__VLS_ctx.formData.company_name)), });
const __VLS_348 = __VLS_pickFunctionalComponentCtx(__VLS_345, __VLS_347)!;
let __VLS_349!: __VLS_NormalizeEmits<typeof __VLS_348.emit>;
}
// @ts-ignore
[formData, formData, formData, formData, formData,];
}
(__VLS_343.slots!).default;
}
{
const __VLS_350 = __VLS_intrinsicElements["a"];
const __VLS_351 = __VLS_elementAsFunctionalComponent(__VLS_350);
const __VLS_352 = __VLS_351({ ...{}, href: ("#"), class: ("img-wrapper profile-pic"), }, ...__VLS_functionalComponentArgsRest(__VLS_351));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_350, typeof __VLS_352> & Record<string, unknown>) => void)({ ...{}, href: ("#"), class: ("img-wrapper profile-pic"), });
const __VLS_353 = __VLS_pickFunctionalComponentCtx(__VLS_350, __VLS_352)!;
let __VLS_354!: __VLS_NormalizeEmits<typeof __VLS_353.emit>;
if (__VLS_ctx.formData.profile_picture) {
{
const __VLS_355 = __VLS_intrinsicElements["img"];
const __VLS_356 = __VLS_elementAsFunctionalComponent(__VLS_355);
const __VLS_357 = __VLS_356({ ...{}, src: ((__VLS_ctx.formData.profile_picture)), alt: ((__VLS_ctx.formData.name)), }, ...__VLS_functionalComponentArgsRest(__VLS_356));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_355, typeof __VLS_357> & Record<string, unknown>) => void)({ ...{}, src: ((__VLS_ctx.formData.profile_picture)), alt: ((__VLS_ctx.formData.name)), });
const __VLS_358 = __VLS_pickFunctionalComponentCtx(__VLS_355, __VLS_357)!;
let __VLS_359!: __VLS_NormalizeEmits<typeof __VLS_358.emit>;
}
// @ts-ignore
[formData, formData, formData, formData, formData,];
}
(__VLS_353.slots!).default;
}
{
const __VLS_360 = __VLS_intrinsicElements["ul"];
const __VLS_361 = __VLS_elementAsFunctionalComponent(__VLS_360);
const __VLS_362 = __VLS_361({ ...{}, class: ("user-info"), }, ...__VLS_functionalComponentArgsRest(__VLS_361));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_360, typeof __VLS_362> & Record<string, unknown>) => void)({ ...{}, class: ("user-info"), });
const __VLS_363 = __VLS_pickFunctionalComponentCtx(__VLS_360, __VLS_362)!;
let __VLS_364!: __VLS_NormalizeEmits<typeof __VLS_363.emit>;
{
const __VLS_365 = __VLS_intrinsicElements["li"];
const __VLS_366 = __VLS_elementAsFunctionalComponent(__VLS_365);
const __VLS_367 = __VLS_366({ ...{}, class: ("user-company-name"), }, ...__VLS_functionalComponentArgsRest(__VLS_366));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_365, typeof __VLS_367> & Record<string, unknown>) => void)({ ...{}, class: ("user-company-name"), });
const __VLS_368 = __VLS_pickFunctionalComponentCtx(__VLS_365, __VLS_367)!;
let __VLS_369!: __VLS_NormalizeEmits<typeof __VLS_368.emit>;
(__VLS_ctx.formData.company_name);
(__VLS_368.slots!).default;
}
{
const __VLS_370 = __VLS_intrinsicElements["li"];
const __VLS_371 = __VLS_elementAsFunctionalComponent(__VLS_370);
const __VLS_372 = __VLS_371({ ...{}, class: ("user-desigination"), }, ...__VLS_functionalComponentArgsRest(__VLS_371));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_370, typeof __VLS_372> & Record<string, unknown>) => void)({ ...{}, class: ("user-desigination"), });
const __VLS_373 = __VLS_pickFunctionalComponentCtx(__VLS_370, __VLS_372)!;
let __VLS_374!: __VLS_NormalizeEmits<typeof __VLS_373.emit>;
(__VLS_ctx.formData.title);
(__VLS_373.slots!).default;
}
(__VLS_363.slots!).default;
}
{
const __VLS_375 = __VLS_intrinsicElements["h4"];
const __VLS_376 = __VLS_elementAsFunctionalComponent(__VLS_375);
const __VLS_377 = __VLS_376({ ...{}, class: ("mb-0"), }, ...__VLS_functionalComponentArgsRest(__VLS_376));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_375, typeof __VLS_377> & Record<string, unknown>) => void)({ ...{}, class: ("mb-0"), });
const __VLS_378 = __VLS_pickFunctionalComponentCtx(__VLS_375, __VLS_377)!;
let __VLS_379!: __VLS_NormalizeEmits<typeof __VLS_378.emit>;
__VLS_directiveFunction(__VLS_ctx.vText)((__VLS_ctx.formData.name));
}
{
const __VLS_380 = __VLS_intrinsicElements["p"];
const __VLS_381 = __VLS_elementAsFunctionalComponent(__VLS_380);
const __VLS_382 = __VLS_381({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_381));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_380, typeof __VLS_382> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_383 = __VLS_pickFunctionalComponentCtx(__VLS_380, __VLS_382)!;
let __VLS_384!: __VLS_NormalizeEmits<typeof __VLS_383.emit>;
__VLS_directiveFunction(__VLS_ctx.vText)((__VLS_ctx.formData.bio));
}
{
const __VLS_385 = __VLS_intrinsicElements["div"];
const __VLS_386 = __VLS_elementAsFunctionalComponent(__VLS_385);
const __VLS_387 = __VLS_386({ ...{}, class: ("flex-row info-btns"), }, ...__VLS_functionalComponentArgsRest(__VLS_386));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_385, typeof __VLS_387> & Record<string, unknown>) => void)({ ...{}, class: ("flex-row info-btns"), });
const __VLS_388 = __VLS_pickFunctionalComponentCtx(__VLS_385, __VLS_387)!;
let __VLS_389!: __VLS_NormalizeEmits<typeof __VLS_388.emit>;
{
const __VLS_390 = __VLS_intrinsicElements["a"];
const __VLS_391 = __VLS_elementAsFunctionalComponent(__VLS_390);
const __VLS_392 = __VLS_391({ ...{}, class: ("info"), href: (""), }, ...__VLS_functionalComponentArgsRest(__VLS_391));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_390, typeof __VLS_392> & Record<string, unknown>) => void)({ ...{}, class: ("info"), href: (""), });
const __VLS_393 = __VLS_pickFunctionalComponentCtx(__VLS_390, __VLS_392)!;
let __VLS_394!: __VLS_NormalizeEmits<typeof __VLS_393.emit>;
(__VLS_393.slots!).default;
}
{
const __VLS_395 = __VLS_intrinsicElements["a"];
const __VLS_396 = __VLS_elementAsFunctionalComponent(__VLS_395);
const __VLS_397 = __VLS_396({ ...{}, class: ("info"), href: (""), }, ...__VLS_functionalComponentArgsRest(__VLS_396));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_395, typeof __VLS_397> & Record<string, unknown>) => void)({ ...{}, class: ("info"), href: (""), });
const __VLS_398 = __VLS_pickFunctionalComponentCtx(__VLS_395, __VLS_397)!;
let __VLS_399!: __VLS_NormalizeEmits<typeof __VLS_398.emit>;
(__VLS_398.slots!).default;
}
{
const __VLS_400 = __VLS_intrinsicElements["a"];
const __VLS_401 = __VLS_elementAsFunctionalComponent(__VLS_400);
const __VLS_402 = __VLS_401({ ...{}, class: ("info"), href: (""), }, ...__VLS_functionalComponentArgsRest(__VLS_401));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_400, typeof __VLS_402> & Record<string, unknown>) => void)({ ...{}, class: ("info"), href: (""), });
const __VLS_403 = __VLS_pickFunctionalComponentCtx(__VLS_400, __VLS_402)!;
let __VLS_404!: __VLS_NormalizeEmits<typeof __VLS_403.emit>;
(__VLS_403.slots!).default;
}
(__VLS_388.slots!).default;
}
{
const __VLS_405 = __VLS_intrinsicElements["a"];
const __VLS_406 = __VLS_elementAsFunctionalComponent(__VLS_405);
const __VLS_407 = __VLS_406({ ...{}, href: ("#"), class: ("site-btn dark-btn"), }, ...__VLS_functionalComponentArgsRest(__VLS_406));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_405, typeof __VLS_407> & Record<string, unknown>) => void)({ ...{}, href: ("#"), class: ("site-btn dark-btn"), });
const __VLS_408 = __VLS_pickFunctionalComponentCtx(__VLS_405, __VLS_407)!;
let __VLS_409!: __VLS_NormalizeEmits<typeof __VLS_408.emit>;
(__VLS_408.slots!).default;
}
{
const __VLS_410 = __VLS_intrinsicElements["a"];
const __VLS_411 = __VLS_elementAsFunctionalComponent(__VLS_410);
const __VLS_412 = __VLS_411({ ...{}, href: ("#"), class: ("site-btn"), }, ...__VLS_functionalComponentArgsRest(__VLS_411));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_410, typeof __VLS_412> & Record<string, unknown>) => void)({ ...{}, href: ("#"), class: ("site-btn"), });
const __VLS_413 = __VLS_pickFunctionalComponentCtx(__VLS_410, __VLS_412)!;
let __VLS_414!: __VLS_NormalizeEmits<typeof __VLS_413.emit>;
(__VLS_413.slots!).default;
}
{
const __VLS_415 = __VLS_intrinsicElements["h3"];
const __VLS_416 = __VLS_elementAsFunctionalComponent(__VLS_415);
const __VLS_417 = __VLS_416({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_416));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_415, typeof __VLS_417> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_418 = __VLS_pickFunctionalComponentCtx(__VLS_415, __VLS_417)!;
let __VLS_419!: __VLS_NormalizeEmits<typeof __VLS_418.emit>;
(__VLS_418.slots!).default;
}
{
const __VLS_420 = __VLS_intrinsicElements["div"];
const __VLS_421 = __VLS_elementAsFunctionalComponent(__VLS_420);
const __VLS_422 = __VLS_421({ ...{}, class: ("flex-row social-media"), }, ...__VLS_functionalComponentArgsRest(__VLS_421));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_420, typeof __VLS_422> & Record<string, unknown>) => void)({ ...{}, class: ("flex-row social-media"), });
const __VLS_423 = __VLS_pickFunctionalComponentCtx(__VLS_420, __VLS_422)!;
let __VLS_424!: __VLS_NormalizeEmits<typeof __VLS_423.emit>;
for (const [network, index] of __VLS_getVForSourceType((__VLS_ctx.formData.networks)!)) {
{
const __VLS_425 = __VLS_intrinsicElements["a"];
const __VLS_426 = __VLS_elementAsFunctionalComponent(__VLS_425);
const __VLS_427 = __VLS_426({ ...{}, class: (""), href: ((network.url)), target: ("_blank"), }, ...__VLS_functionalComponentArgsRest(__VLS_426));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_425, typeof __VLS_427> & Record<string, unknown>) => void)({ ...{}, class: (""), href: ((network.url)), target: ("_blank"), });
const __VLS_428 = __VLS_pickFunctionalComponentCtx(__VLS_425, __VLS_427)!;
let __VLS_429!: __VLS_NormalizeEmits<typeof __VLS_428.emit>;
{
const __VLS_430 = __VLS_intrinsicElements["span"];
const __VLS_431 = __VLS_elementAsFunctionalComponent(__VLS_430);
const __VLS_432 = __VLS_431({ ...{}, class: ("icon svg-icon"), }, ...__VLS_functionalComponentArgsRest(__VLS_431));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_430, typeof __VLS_432> & Record<string, unknown>) => void)({ ...{}, class: ("icon svg-icon"), });
const __VLS_433 = __VLS_pickFunctionalComponentCtx(__VLS_430, __VLS_432)!;
let __VLS_434!: __VLS_NormalizeEmits<typeof __VLS_433.emit>;
(network.social_network.icon);
}
{
const __VLS_435 = __VLS_intrinsicElements["span"];
const __VLS_436 = __VLS_elementAsFunctionalComponent(__VLS_435);
const __VLS_437 = __VLS_436({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_436));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_435, typeof __VLS_437> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_438 = __VLS_pickFunctionalComponentCtx(__VLS_435, __VLS_437)!;
let __VLS_439!: __VLS_NormalizeEmits<typeof __VLS_438.emit>;
__VLS_directiveFunction(__VLS_ctx.vText)((network.name));
}
(__VLS_428.slots!).default;
}
// @ts-ignore
[formData, formData, formData, formData, formData,];
}
(__VLS_423.slots!).default;
}
(__VLS_338.slots!).default;
}
(__VLS_333.slots!).default;
}
(__VLS_28.slots!).default;
}
(__VLS_23.slots!).default;
}
(__VLS_13.slots!).default;
}
(__VLS_8.slots!).default;
}
if (typeof __VLS_styleScopedClasses === 'object' && !Array.isArray(__VLS_styleScopedClasses)) {
}
var __VLS_slots!: {};
return __VLS_slots;
}
