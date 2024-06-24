/**
 * @file
 * Message template overrides.
 */
if (!Drupal.theme.wb_horizon) {
  Drupal.theme.wb_horizon = {};
}
((Drupal) => {
  Drupal.theme.wb_horizon.close_button = () => {
    return '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
  };
  //
  Drupal.theme.wb_horizon.icon_default = () => {
    return `<svg class="bi flex-shrink-0 me-4" width="1.8rem" height="1.8rem" role="img" aria-label="Warning:" viewBox="0 0 16 16"> 
              <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>            
            </svg>`;
  };
  //
  Drupal.theme.wb_horizon.icon_error = () => {
    return `<svg class="bi flex-shrink-0 me-4" width="1.8rem" height="1.8rem" role="img" aria-label="Warning:" viewBox="0 0 16 16"> 
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
           </svg>`;
  };
  //
  Drupal.theme.wb_horizon.icon_success = () => {
    return `<svg class="bi flex-shrink-0 me-4" width="1.8rem" height="1.8rem" role="img" aria-label="Warning:" viewBox="0 0 16 16">  
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>`;
  };
  //
  /**
   * Overrides message theme function.
   *
   * @param {object} message
   *   The message object.
   * @param {string} message.text
   *   The message text.
   * @param {object} options
   *   The message context.
   * @param {string} options.type
   *   The message type.
   * @param {string} options.id
   *   ID of the message, for reference.
   *
   * @return {HTMLElement}
   *   A DOM Node.
   */
  Drupal.theme.message = ({ text }, { type, id }) => {
    // const messagesTypes = Drupal.Message.getMessageTypeLabels();
    const messageWrapper = document.createElement("div");
    const btn_close = Drupal.theme.wb_horizon && Drupal.theme.wb_horizon.close_button ? Drupal.theme.wb_horizon.close_button() : "";
    const icon_success = Drupal.theme.wb_horizon && Drupal.theme.wb_horizon.icon_success ? Drupal.theme.wb_horizon.icon_success() : "";
    const icon_error = Drupal.theme.wb_horizon && Drupal.theme.wb_horizon.icon_error ? Drupal.theme.wb_horizon.icon_error() : "";
    const icon_default = Drupal.theme.wb_horizon && Drupal.theme.wb_horizon.icon_default ? Drupal.theme.wb_horizon.icon_default() : "";
    //
    var alert_type = "";
    var icon = "";
    switch (type) {
      case "status":
        alert_type = "success";
        icon = icon_success;
        break;
      case "warning":
        alert_type = "warning";
        icon = icon_error;
        break;
      case "error":
        alert_type = "danger";
        icon = icon_error;
        break;
      default:
        alert_type = "infos";
        icon = icon_default;
        break;
    }
    messageWrapper.setAttribute("class", `messages messages--${type} messages-list__item alert alert-${alert_type} alert-dismissible fade show d-flex align-items-center `);
    messageWrapper.setAttribute("role", type === "error" || type === "warning" ? "alert" : "status");
    messageWrapper.setAttribute("aria-labelledby", `${id}-title`);
    messageWrapper.setAttribute("data-drupal-message-id", id);
    messageWrapper.setAttribute("data-drupal-message-type", type);
    messageWrapper.innerHTML = `
    <div class="messages__content pe-5">
      ${icon}
      ${text}
      ${btn_close}
    </div>
  `;

    return messageWrapper;
  };
})(Drupal);
