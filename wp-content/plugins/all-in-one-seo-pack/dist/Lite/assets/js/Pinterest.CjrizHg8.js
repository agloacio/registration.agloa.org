import{a as f,e as g}from"./index.ByF2aI-G.js";import{u as y}from"./MetaTags.CdjgvZV1.js";import{C as b}from"./Card.Bqq4cvaT.js";import{C as k}from"./SettingsRow.Ch1FEDlp.js";import"./translations.Ur07Kmot.js";import{_ as w}from"./_plugin-vue_export-helper.BN1snXvA.js";import{_ as t}from"./default-i18n.DvLqo3S3.js";import{v as i,c as h,C as a,l,o as C,a as n,x,t as u}from"./runtime-dom.esm-bundler.DKw-RQqs.js";import"./helpers.yjC6K_2A.js";import"./Tooltip.B0brI66q.js";import"./Caret.DMa7g0j7.js";import"./index.Olu2afa7.js";import"./Slide.CdVEnD7S.js";import"./Row.D0941SYu.js";const o="all-in-one-seo-pack",P={setup(){const{maybeUpdateId:p}=y();return{maybeUpdateId:p,optionsStore:f(),links:g}},components:{CoreCard:b,CoreSettingsRow:k},data(){return{pagePostOptions:[],strings:{pinterest:t("Pinterest",o),description:t("Pinterest uses Open Graph metadata just like Facebook, so be sure to keep Open Graph enabled on the Facebook tab checked if you want to optimize your site for Pinterest.",o),learnHowToGetPinterestTag:t("Learn how to get your Pinterest Verification Code",o),skipStep:t("If you have already confirmed your website with Pinterest, you can skip the step below.",o),pinterestVerificationCode:t("Pinterest Verification Code",o)}}}},V={class:"aioseo-pinterest"},T={class:"aioseo-settings-row aioseo-section-description"},S=["innerHTML"],v=n("br",null,null,-1),L=n("br",null,null,-1);function B(p,s,G,r,e,H){const m=i("base-input"),_=i("core-settings-row"),d=i("core-card");return C(),h("div",V,[a(d,{slug:"pinterest","header-text":e.strings.pinterest},{default:l(()=>[n("div",T,[x(u(e.strings.description)+" ",1),n("span",{innerHTML:r.links.getDocLink(e.strings.learnHowToGetPinterestTag,"pinterestSiteVerification",!0)},null,8,S),v,L,n("strong",null,u(e.strings.skipStep),1)]),a(_,{name:e.strings.pinterestVerificationCode,align:""},{content:l(()=>[a(m,{size:"medium",modelValue:r.optionsStore.options.webmasterTools.pinterest,"onUpdate:modelValue":s[0]||(s[0]=c=>r.optionsStore.options.webmasterTools.pinterest=c),onBlur:s[1]||(s[1]=c=>r.maybeUpdateId("pinterest"))},null,8,["modelValue"])]),_:1},8,["name"])]),_:1},8,["header-text"])])}const K=w(P,[["render",B]]);export{K as default};
