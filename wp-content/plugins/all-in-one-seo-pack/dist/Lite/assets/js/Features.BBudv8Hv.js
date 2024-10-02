import{h as B,r as O}from"./index.ByF2aI-G.js";import{u as T}from"./Wizard.BxAGpy3y.js";import{B as U}from"./Checkbox.BAIONgTE.js";import{C as E}from"./ProBadge.BJ3spTo5.js";import{G as L,a as F}from"./Row.D0941SYu.js";import{W as q,a as G,b as I}from"./Header.CIUjiXYQ.js";import{W as D}from"./CloseAndExit.DHdNyssQ.js";import{_ as R}from"./Steps.DRDaoBrO.js";import"./translations.Ur07Kmot.js";import{_ as j}from"./_plugin-vue_export-helper.BN1snXvA.js";import{_ as p,a as g}from"./default-i18n.DvLqo3S3.js";import{v as r,c as _,C as t,l as n,o as h,a as c,x as f,t as u,F as H,J,k as K,b as W,G as M}from"./runtime-dom.esm-bundler.DKw-RQqs.js";import"./helpers.yjC6K_2A.js";import"./addons.C_QAj7aO.js";import"./upperFirst.BjBqmCj-.js";import"./_stringToArray.DnK4tKcY.js";import"./toString.Dc7QMRQR.js";import"./Checkmark.BedAg8BV.js";import"./Logo.C2KPC9qS.js";import"./Index.CzfUkh0l.js";import"./Caret.DMa7g0j7.js";const m="all-in-one-seo-pack",Q={setup(){const{features:e,needsUpsell:i,strings:a}=T({stage:"features"});return{composableStrings:a,features:e,needsUpsell:i,setupWizardStore:B()}},components:{BaseCheckbox:U,CoreProBadge:E,GridColumn:L,GridRow:F,WizardBody:q,WizardCloseAndExit:D,WizardContainer:G,WizardHeader:I,WizardSteps:R},data(){return{loading:!1,strings:O(this.composableStrings,{whichFeatures:p("Which SEO features do you want to enable?",m),description:p("We have already selected our recommended features based on your site category, but you can use the following features to fine-tune your site.",m)})}},computed:{showPluginsAll(){return(this.setupWizardStore.features.includes("analytics")||this.setupWizardStore.features.includes("broken-link-checker")||this.setupWizardStore.features.includes("conversion-tools"))&&(this.setupWizardStore.features.includes("aioseo-eeat")||this.setupWizardStore.features.includes("aioseo-image-seo")||this.setupWizardStore.features.includes("aioseo-index-now")||this.setupWizardStore.features.includes("aioseo-link-assistant")||this.setupWizardStore.features.includes("aioseo-local-business")||this.setupWizardStore.features.includes("aioseo-news-sitemap")||this.setupWizardStore.features.includes("aioseo-redirects")||this.setupWizardStore.features.includes("aioseo-rest-api")||this.setupWizardStore.features.includes("aioseo-video-sitemap"))},showPluginsAddons(){return(!this.setupWizardStore.features.includes("analytics")||!this.setupWizardStore.features.includes("broken-link-checker")||!this.setupWizardStore.features.includes("conversion-tools"))&&(this.setupWizardStore.features.includes("aioseo-eeat")||this.setupWizardStore.features.includes("aioseo-image-seo")||this.setupWizardStore.features.includes("aioseo-index-now")||this.setupWizardStore.features.includes("aioseo-link-assistant")||this.setupWizardStore.features.includes("aioseo-local-business")||this.setupWizardStore.features.includes("aioseo-news-sitemap")||this.setupWizardStore.features.includes("aioseo-redirects")||this.setupWizardStore.features.includes("aioseo-rest-api")||this.setupWizardStore.features.includes("aioseo-video-sitemap"))},showPluginsOnly(){return(this.setupWizardStore.features.includes("analytics")||this.setupWizardStore.features.includes("broken-link-checker")||this.setupWizardStore.features.includes("conversion-tools"))&&!this.setupWizardStore.features.includes("aioseo-eeat")&&!this.setupWizardStore.features.includes("aioseo-image-seo")&&!this.setupWizardStore.features.includes("aioseo-index-now")&&!this.setupWizardStore.features.includes("aioseo-link-assistant")&&!this.setupWizardStore.features.includes("aioseo-local-business")&&!this.setupWizardStore.features.includes("aioseo-news-sitemap")&&!this.setupWizardStore.features.includes("aioseo-redirects")&&!this.setupWizardStore.features.includes("aioseo-rest-api")&&!this.setupWizardStore.features.includes("aioseo-video-sitemap")},getPluginsText(){return this.showPluginsOnly?g(p("The following plugins will be installed: %1$s",m),this.getPluginNames):this.showPluginsAddons?g(p("The following %1$s addons will be installed: %2$s",m),"AIOSEO",this.getPluginNames):this.showPluginsAll?g(p("The following plugins and %1$s addons will be installed: %2$s",m),"AIOSEO",this.getPluginNames):null},getPluginNames(){const e=[];this.features.forEach(o=>{this.setupWizardStore.features.includes(o.value)&&o.pluginName&&e.push(o.pluginName)});let i="";return 1<e.length?i=g(p(" and %1$s",m),e[e.length-1]):i=e[e.length-1],delete e[e.length-1],e.join(", ").replace(/(^[,\s]+)|([,\s]+$)/g,"")+i}},methods:{preventUncheck(e,i){i.required&&(e.preventDefault(),e.stopPropagation())},getValue(e){return this.setupWizardStore.features.includes(e.value)},updateValue(e,i){const a=[...this.setupWizardStore.features];if(e){a.push(i.value),this.setupWizardStore.features=a;return}const o=a.findIndex(l=>l===i.value);o!==-1&&a.splice(o,1),this.setupWizardStore.features=a},saveAndContinue(){this.loading=!0,this.setupWizardStore.saveWizard("features").then(()=>{this.$router.push(this.setupWizardStore.getNextLink)})}}},X={class:"aioseo-wizard-features"},Y={class:"header"},Z={class:"description"},$={class:"settings-name"},ee={class:"name small-margin"},se={class:"aioseo-description-text"},te={key:0,class:"aioseo-installs-text"},ie={class:"go-back"},oe=c("div",{class:"spacer"},null,-1),re={key:0,class:"plugins"};function ae(e,i,a,o,l,d){const w=r("wizard-header"),b=r("wizard-steps"),v=r("core-pro-badge"),S=r("grid-column"),y=r("base-checkbox"),x=r("grid-row"),k=r("router-link"),P=r("base-button"),C=r("wizard-body"),N=r("wizard-close-and-exit"),A=r("wizard-container");return h(),_("div",X,[t(w),t(A,null,{default:n(()=>[t(C,null,{footer:n(()=>[c("div",ie,[t(k,{to:o.setupWizardStore.getPrevLink,class:"no-underline"},{default:n(()=>[f("←")]),_:1},8,["to"]),f("   "),t(k,{to:o.setupWizardStore.getPrevLink},{default:n(()=>[f(u(l.strings.goBack),1)]),_:1},8,["to"])]),oe,t(P,{type:"blue",loading:l.loading,onClick:d.saveAndContinue},{default:n(()=>[f(u(l.strings.saveAndContinue)+" →",1)]),_:1},8,["loading","onClick"])]),default:n(()=>[t(b),c("div",Y,u(l.strings.whichFeatures),1),c("div",Z,u(l.strings.description),1),(h(!0),_(H,null,J(o.features,(s,V)=>(h(),_("div",{key:V,class:"feature-grid small-padding medium-margin"},[t(x,null,{default:n(()=>[t(S,{xs:"11"},{default:n(()=>[c("div",$,[c("div",ee,[f(u(s.name)+" ",1),o.needsUpsell(s)?(h(),K(v,{key:0})):W("",!0)]),c("div",se,u(s.description),1),s.installs&&d.getValue(s)?(h(),_("div",te,u(s.installs),1)):W("",!0)])]),_:2},1024),t(S,{xs:"1"},{default:n(()=>[t(y,{round:"",class:M({"no-clicks":s.required}),type:s.required?"green":"blue",modelValue:s.required?!0:d.getValue(s),"onUpdate:modelValue":z=>d.updateValue(z,s),onClick:z=>d.preventUncheck(z,s)},null,8,["class","type","modelValue","onUpdate:modelValue","onClick"])]),_:2},1024)]),_:2},1024)]))),128))]),_:1}),d.getPluginsText?(h(),_("div",re,u(d.getPluginsText),1)):W("",!0),t(N)]),_:1})])}const Ce=j(Q,[["render",ae]]);export{Ce as default};
